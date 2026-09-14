# Telegram Sentiment Analysis

## Project Overview

This project focuses on sentiment analysis of Telegram user reviews using Natural Language Processing (NLP) and Machine Learning.

The project processes text data, performs text preprocessing, extracts numerical features, and applies machine learning models to classify user reviews into positive and negative sentiment.

## Objectives

- Analyze sentiment from Telegram user reviews.
- Perform text preprocessing for Indonesian language data.
- Convert text into numerical features using Bag of Words and TF-IDF.
- Build machine learning models for sentiment classification.
- Evaluate and compare model performance.
- Explore sentiment patterns through text visualization.

## Project Workflow

The project consists of several stages:

1. Data Scraping
2. Data Labeling
3. Text Preprocessing
4. Feature Extraction
5. Sentiment Classification
6. DistilBERT Experiment
7. Word Cloud Visualization

## Methodology

### 1. Data Scraping

Telegram review data was collected and prepared as the dataset for sentiment analysis.

### 2. Data Labeling

The collected text data was labeled into positive and negative sentiment categories.

### 3. Text Preprocessing

The preprocessing stage includes:

- Converting text to lowercase
- Removing URLs
- Removing mentions and hashtags
- Removing numbers
- Removing punctuation
- Removing extra spaces
- Normalizing informal words
- Removing stopwords
- Indonesian text stemming

### 4. Feature Extraction

Two text representation approaches were explored:

- Bag of Words (BoW)
- TF-IDF

The TF-IDF representation was used for the machine learning classification process.

### 5. Sentiment Classification

Machine learning models were used to classify reviews into positive and negative sentiment.

The models include:

- Naive Bayes
- Linear Support Vector Machine (SVM)

### 6. DistilBERT

A DistilBERT-based approach was also explored as part of the project.

### 7. Word Cloud

Word Cloud visualization was used to explore frequently occurring words within the sentiment categories.

## Model Performance

The classification results obtained from the experiment include:

| Model | Accuracy |
|---|---:|
| Naive Bayes | 85.24% |
| Linear SVM | 93.33% |

The Linear SVM model achieved the higher accuracy in the evaluated test set.

## Dataset

The dataset consists of Telegram text reviews that were labeled into positive and negative sentiment categories.

After preprocessing and cleaning, the dataset contained:

- 1,064 text records
- 624 negative reviews
- 440 positive reviews

## Tools & Technologies

- Python
- Pandas
- NumPy
- Scikit-learn
- NLTK
- Sastrawi
- Matplotlib
- Seaborn
- Joblib
- Jupyter Notebook / Google Colab

## Project Structure

```text
telegram-sentiment-analysis/
│
├── notebooks/
│   ├── T1_Scraping.ipynb
│   ├── T2_Labeling.ipynb
│   ├── T3_Preprocessing.ipynb
│   ├── T4_FeatureExtraction.ipynb
│   ├── T5_Klasifikasi.ipynb
│   ├── T6_DistilBERT.ipynb
│   └── T7_WordCloud.ipynb
│
├── models/
│   └── trained models
│
└── README.md
