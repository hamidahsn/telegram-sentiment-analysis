from flask import Flask, request, jsonify
import joblib
import re

app = Flask(__name__)

# Load model SVM dan TF-IDF
svm = joblib.load('svm_sentiment.pkl')
tfidf = joblib.load('tfidf_vectorizer.pkl')

def preprocess(text):
    text = text.lower()
    text = re.sub(r'[^a-z\s]', '', text)
    return text

@app.route('/predict', methods=['POST'])
def predict():
    data = request.get_json()
    teks = data.get('teks', '')
    teks_lower = teks.lower().strip()

    # -------------------------------------------------------------
    # 1. RULE-BASED INTENTS
    # -------------------------------------------------------------
    sapaan_keywords = ['hai', 'halo', 'hi', 'pagi', 'siang', 'malam', 'permisi']
    data_keywords = ['berapa data', 'jumlah data', 'total data', 'banyak data']
    negatif_keywords = ['berapa negatif', 'total negatif', 'jumlah negatif', 'pesan negatif']
    positif_keywords = ['berapa positif', 'total positif', 'jumlah positif', 'pesan positif']
    bantuan_keywords = ['bisa apa', 'fitur', 'bantuan', 'menu', 'bisa lakukan apa', 'kamu bisa apa aja']

    # Cek kata sapaan
    if any(k == teks_lower or teks_lower.startswith(k) for k in sapaan_keywords):
        pesan_balasan = 'Halo! 👋 Saya chatbot analisis sentimen Telegram. Ketik pesan atau masukan ulasan untuk dianalisis.'
        
    # Cek intent data
    elif any(k in teks_lower for k in data_keywords):
        pesan_balasan = 'Jumlah data Telegram yang tersedia di sistem adalah 1065 pesan.'

    elif any(k in teks_lower for k in negatif_keywords):
        pesan_balasan = 'Jumlah pesan dengan sentimen negatif adalah 624 pesan.'

    elif any(k in teks_lower for k in positif_keywords):
        pesan_balasan = 'Jumlah pesan dengan sentimen positif adalah 441 pesan.'

    elif any(k in teks_lower for k in bantuan_keywords):
        pesan_balasan = 'Fitur saya: 1. Analisis sentimen ulasan (otomatis). 2. Menampilkan info jumlah data/sentimen Telegram.'

    # -------------------------------------------------------------
    # 2. MACHINE LEARNING (Jika bukan intent, jalankan PREDIKSI SVM)
    # -------------------------------------------------------------
    else:
        clean_text = preprocess(teks)
        vector = tfidf.transform([clean_text])
        hasil = svm.predict(vector)[0]

        if hasil.lower() == 'positif':
            pesan_balasan = f"🟢 Hasil analisis sentimen: POSITIF. Pesan: {teks}"
        else:
            pesan_balasan = f"🔴 Hasil analisis sentimen: NEGATIF. Pesan: {teks}"

    # Mengembalikan teks balasan langsung ke dalam properti 'sentimen'
    # agar langsung dibaca oleh tampilan frontend PHP kamu
    return jsonify({
        'teks': teks,
        'sentimen': pesan_balasan
    })

if __name__ == '__main__':
    app.run(host='127.0.0.1', port=5000, debug=True)