import os
import pandas as pd
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
import sys

# MySQL Database Connection
import pymysql

con = pymysql.connect(host='localhost', user='root', password='', database='rtsdb')
cursor = con.cursor()

# Query to fetch data from tblrcmd
query = "SELECT title, ingredients, instructions, image_name, preparation_time,yields FROM tblrcmd"
cursor.execute(query)
result = cursor.fetchall()

# Create DataFrame from fetched results
df = pd.DataFrame(result, columns=['title', 'ingredients', 'instructions', 'image_name', 'preparation_time', 'yields'])
# Concatenate 'ingredients' and 'title' columns
df['combined_text'] = df['ingredients'].astype(str) + ' ' + df['title']

# TF-IDF Vectorization for combined_text
tfidf_vectorizer = TfidfVectorizer(stop_words='english')
tfidf_matrix = tfidf_vectorizer.fit_transform(df['combined_text'])

# Calculate cosine similarity
cosine_sim = cosine_similarity(tfidf_matrix, tfidf_matrix)

# Function to get recipe recommendations based on command-line arguments
def get_recommendations(query, prep_time, num_people, cosine_sim=cosine_sim):
    filtered_df = df[df['title'] == query]
    if not filtered_df.empty:
        idx = filtered_df.index[0]
        sim_scores = list(enumerate(cosine_sim[idx]))
        sim_scores = sorted(sim_scores, key=lambda x: x[1], reverse=True)
        sim_scores = sim_scores[1:11]  # Top 10 similar recipes
        recipe_indices = [i[0] for i in sim_scores]
        return df[['title', 'instructions', 'image_name']].iloc[recipe_indices]
    else:
        # Find recipes with the input word in ingredients column
        filtered_recipes = df[df['ingredients'].str.contains(query, case=False)]
        if not filtered_recipes.empty:
            # Filter based on prep_time (close values)
            filtered_by_time = filtered_recipes[
                filtered_recipes['preparation_time'].between(prep_time - 5, prep_time + 5)
            ]
            if not filtered_by_time.empty:
                # Filter based on num_people
                filtered_by_people = filtered_by_time[filtered_by_time['yields'] >= num_people]
                if not filtered_by_people.empty:
                    return filtered_by_people[['title', 'instructions', 'image_name']].head(5)
                else:
                    return filtered_by_time[['title', 'instructions', 'image_name']].head(5)
            else:
                return filtered_recipes[['title', 'instructions', 'image_name']].head(5)
        else:
            return pd.DataFrame(columns=['title', 'instructions', 'image_name'])  # Empty DataFrame

# Example usage with command-line arguments
if __name__ == "__main__":
    query = sys.argv[1]
    prep_time = int(sys.argv[2])
    num_people = int(sys.argv[3])
    recommendations = get_recommendations(query, prep_time, num_people)

    # Construct HTML content with recommendations
    image_folder = '/RTS/user/Food_Images/Food_Images/'
    html_content = """
        <!DOCTYPE html>
        <html>
        <head>
            <title>Recommendations</title>
            <script>
                function toggleInstructions(id) {
                    var instructions = document.getElementById(id);
                    if (instructions.style.display === 'none') {
                        instructions.style.display = 'block';
                    } else {
                        instructions.style.display = 'none';
                    }
                }
            </script>
        </head>
        <body>
        """
    for index, row in recommendations.iterrows():
        image_path = os.path.join(image_folder, row['image_name'] + '.jpg')
        html_content += f"<h2>{row['title']}</h2>"
        # Add a clickable link to toggle instructions visibility
        html_content += f'<p><a href="javascript:void(0);" onclick="toggleInstructions(\'instructions_{index}\')">Cooking Instructions</a></p>'
        # Initially hide the instructions with a unique ID
        html_content += f"<div id='instructions_{index}' style='display:none;'>{row['instructions']}</div>"
        html_content += f'<img src="{image_path}" width="200"><br><br>'
        html_content += "</body></html>"

    # Print HTML content to be captured by PHP
    print(html_content)