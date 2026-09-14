# Telegram Sentiment Analysis

A Natural Language Processing (NLP) project for analyzing the sentiment of Telegram user reviews using text preprocessing, TF-IDF feature extraction, and machine learning classification.

The project also integrates the trained sentiment classification model into a web-based chatbot that allows users to submit text and receive sentiment predictions.

---

## Project Overview

This project analyzes Indonesian-language Telegram user reviews and classifies them into two sentiment categories:

- Positive
- Negative

The project covers the complete workflow from data scraping and labeling to text preprocessing, feature extraction, machine learning classification, visualization, and chatbot integration.

The main machine learning model used in the chatbot is a Linear Support Vector Machine (SVM) with TF-IDF features.

---

## Objectives

The objectives of this project are:

- Collect Telegram review data for sentiment analysis.
- Label text data into positive and negative sentiment categories.
- Perform text preprocessing for Indonesian text.
- Convert text into numerical representations using Bag of Words and TF-IDF.
- Build machine learning models for sentiment classification.
- Evaluate and compare classification performance.
- Explore sentiment patterns using Word Cloud visualization.
- Experiment with a DistilBERT-based approach.
- Integrate the trained sentiment model into a web-based chatbot.

---

## Project Workflow

The project consists of the following stages:

```text
Data Scraping
      ↓
Data Labeling
      ↓
Text Preprocessing
      ↓
Feature Extraction
      ↓
Sentiment Classification
      ↓
DistilBERT Experiment
      ↓
Word Cloud Visualization
      ↓
Chatbot Integration
```

---

## Dataset

The dataset consists of Telegram user review text labeled into positive and negative sentiment categories.

The dataset used in the classification stage contains:

- Total records: 1,064
- Negative: 624
- Positive: 440

The sentiment distribution is:

| Sentiment | Number of Records |
|---|---:|
| Negative | 624 |
| Positive | 440 |
| **Total** | **1,064** |

---

## Methodology

### 1. Data Scraping

Telegram review data was collected and prepared as the source dataset for the sentiment analysis project.

The scraping process is documented in:

```text
notebooks/LK_Hamida_T1_Scraping.ipynb
```

---

### 2. Data Labeling

The collected review data was labeled into positive and negative sentiment categories.

The labeling process is documented in:

```text
notebooks/LK_Hamida_T2_Labeling.ipynb
```

---

### 3. Text Preprocessing

Text preprocessing was performed to clean and normalize the Telegram review data.

The preprocessing steps include:

- Converting text to lowercase
- Removing URLs
- Removing mentions and hashtags
- Removing numbers
- Removing punctuation
- Removing extra spaces
- Normalizing informal words
- Removing stopwords
- Indonesian text stemming

The preprocessing process is documented in:

```text
notebooks/LK_Hamida_T3_Preprocessing.ipynb
```

---

### 4. Feature Extraction

Two text representation techniques were explored:

#### Bag of Words

Bag of Words was implemented using `CountVectorizer`.

#### TF-IDF

TF-IDF was implemented using `TfidfVectorizer`.

The feature extraction process used a maximum of 500 features.

TF-IDF features were subsequently used for the machine learning classification stage.

The feature extraction process is documented in:

```text
notebooks/LK_Hamida_T4_FeatureExtraction.ipynb
```

---

### 5. Sentiment Classification

Two machine learning algorithms were evaluated:

- Naive Bayes
- Linear Support Vector Machine (SVM)

The dataset was divided into training and testing sets using an 80:20 stratified split.

The classification process is documented in:

```text
notebooks/LK_Hamida_T5_Klasifikasi.ipynb
```

---

## Model Performance

The evaluated models produced the following results:

| Model | Accuracy |
|---|---:|
| Naive Bayes | 85.24% |
| Linear SVM | **93.33%** |

Linear SVM achieved the highest accuracy among the evaluated models and was selected as the main sentiment classification model for the chatbot.

For the Linear SVM model, the evaluation produced an overall macro F1-score of approximately 0.93.

---

## DistilBERT Experiment

A DistilBERT-based approach was also explored as part of the project.

The implementation is available in:

```text
notebooks/LK_Hamida_T6_DistilBERT.ipynb
```

This experiment provides an additional comparison between a traditional machine learning approach and a transformer-based NLP approach.

---

## Word Cloud Visualization

Word Cloud visualization was used to explore frequently occurring words within the sentiment categories.

The implementation is available in:

```text
notebooks/LK_Hamida_T7_WordCloud.ipynb
```

---

# Chatbot

The trained sentiment classification model was integrated into a web-based chatbot application.

The chatbot allows users to:

1. Submit a text or review.
2. Receive an automatic sentiment prediction.
3. Ask for information about the available Telegram data.
4. Ask for the number of positive or negative messages.
5. Interact with the chatbot through a simple web interface.

---

## Chatbot Architecture

The chatbot consists of several components:

```text
User
  │
  ▼
HTML / CSS / JavaScript
  │
  ▼
chat.php
  │
  ├── Query Telegram Database
  │
  └── Send text to Flask API
              │
              ▼
          app.py
              │
              ├── Preprocessing
              │
              ├── TF-IDF Vectorizer
              │
              └── SVM Model
              │
              ▼
       Sentiment Prediction
              │
              ▼
          Chatbot Response
```

---

## Chatbot Components

| File | Description |
|---|---|
| `index.html` | Web-based chatbot interface |
| `style.css` | Styling for the chatbot interface |
| `script.js` | Handles user interaction and communication with `chat.php` |
| `chat.php` | Handles requests, database queries, and communication with the Flask API |
| `app.py` | Flask API that performs sentiment prediction |
| `svm_sentiment.pkl` | Trained Linear SVM model |
| `tfidf_vectorizer.pkl` | Trained TF-IDF vectorizer |

---

## Rule-Based Chatbot Features

In addition to machine learning sentiment prediction, the chatbot contains rule-based responses for several intents.

These include:

- Greetings
- Asking for the total number of data
- Asking for the number of negative messages
- Asking for the number of positive messages
- Asking about available chatbot features

For messages that do not match these predefined intents, the chatbot sends the text to the SVM sentiment classification model.

---

## Technologies

### Programming Languages

- Python
- PHP
- JavaScript
- HTML
- CSS

### Python Libraries

- Pandas
- NumPy
- Scikit-learn
- NLTK
- Sastrawi
- Matplotlib
- Seaborn
- Joblib
- Flask

### Tools

- Google Colab
- Jupyter Notebook
- GitHub
- MySQL

---

## Project Structure

```text
telegram-sentiment-analysis/
│
├── chatbot/
│   ├── app.py
│   ├── chat.php
│   ├── index.html
│   ├── script.js
│   ├── style.css
│   ├── svm_sentiment.pkl
│   └── tfidf_vectorizer.pkl
│
├── models/
│   ├── svm_sentiment.pkl
│   └── tfidf_vectorizer.pkl
│
├── notebooks/
│   ├── LK_Hamida_T1_Scraping.ipynb
│   ├── LK_Hamida_T2_Labeling.ipynb
│   ├── LK_Hamida_T3_Preprocessing.ipynb
│   ├── LK_Hamida_T4_FeatureExtraction.ipynb
│   ├── LK_Hamida_T5_Klasifikasi.ipynb
│   ├── LK_Hamida_T6_DistilBERT.ipynb
│   └── LK_Hamida_T7_WordCloud.ipynb
│
├── README.md
├── requirements.txt
└── .gitignore
```

---

## How to Run

### 1. Clone the Repository

Clone this repository to your local computer.

### 2. Install Python Dependencies

Install the required Python libraries:

```bash
pip install -r requirements.txt
```

### 3. Run the Flask API

Navigate to the chatbot directory:

```bash
cd chatbot
```

Then run:

```bash
python app.py
```

The Flask API runs locally on:

```text
http://127.0.0.1:5000
```

### 4. Run the PHP Application

The PHP component requires a local PHP/MySQL environment such as XAMPP.

The database configuration in `chat.php` uses:

```text
Host: localhost
User: root
Database: telegram
```

The required `messages` table should contain the sentiment information used by the chatbot.

### 5. Open the Chatbot

After the PHP server and Flask API are running, open the chatbot interface through the configured local web server.

---

## Model Files

The trained model files are stored in the repository:

```text
models/
├── svm_sentiment.pkl
└── tfidf_vectorizer.pkl
```

The chatbot also contains the model files it uses directly:

```text
chatbot/
├── svm_sentiment.pkl
└── tfidf_vectorizer.pkl
```

These files allow the Flask application to load the trained SVM model and TF-IDF vectorizer for sentiment prediction.

---

## Key Results

The main result of the classification experiment is:

> **Linear SVM achieved 93.33% accuracy**, outperforming Naive Bayes at 85.24% accuracy on the evaluated test set.

The trained Linear SVM model was subsequently integrated into a web-based chatbot for interactive sentiment prediction.

---

## Limitations

Several limitations should be considered:

- The chatbot currently relies on a locally configured Flask API and PHP/MySQL environment.
- The chatbot database connection is configured for a local MySQL database.
- The sentiment model is trained for the sentiment categories available in the project dataset.
- The chatbot's text preprocessing implementation is simpler than the full preprocessing pipeline used during model development.

---

## Future Improvements

Potential improvements for future development include:

- Deploying the chatbot to a public web server.
- Improving the chatbot's natural language understanding.
- Integrating the DistilBERT model into the deployed application.
- Expanding the dataset with more Telegram reviews.
- Improving preprocessing consistency between model training and chatbot prediction.
- Adding more sentiment categories or intent classification.
- Adding visualization of sentiment statistics directly to the chatbot.

---

## Author

**Hamida**

GitHub: `@hamidahsn`
