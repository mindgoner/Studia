import streamlit as st
import pandas as pd
import joblib
from pathlib import Path

st.set_page_config(page_title='Monitorowanie zdrowia', layout='centered')

st.title('Monitorowanie zdrowia')

with st.form('health_form'):
    age = st.number_input('age', min_value=0.0, step=1.0)
    bmi = st.number_input('bmi', min_value=0.0, step=0.1)
    glucose = st.number_input('glucose', min_value=0.0, step=1.0)
    systolic_bp = st.number_input('systolic_bp', min_value=0.0, step=1.0)
    diastolic_bp = st.number_input('diastolic_bp', min_value=0.0, step=1.0)
    submitted = st.form_submit_button('Zapisz i przewiduj')

if submitted:
    row = {
        'age': age,
        'bmi': bmi,
        'glucose': glucose,
        'systolic_bp': systolic_bp,
        'diastolic_bp': diastolic_bp
    }

    pomiary_path = Path('pomiary.csv')
    df_row = pd.DataFrame([row])
    if pomiary_path.exists():
        df_row.to_csv(pomiary_path, mode='a', header=False, index=False)
    else:
        df_row.to_csv(pomiary_path, index=False)

    model_path = Path('risk_model.joblib')
    if not model_path.exists():
        st.error('Brak pliku risk_model.joblib. Uruchom notebook i zapisz model.')
    else:
        model = joblib.load(model_path)
        pred = int(model.predict(df_row)[0])
        if pred == 1:
            st.warning('podwyższone ryzyko')
        else:
            st.success('norma')
