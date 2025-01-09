import csv
import random
from faker import Faker

# Inicjalizacja biblioteki Faker
fake = Faker()

# Ustawienie ziarna dla powtarzalności wyników
Faker.seed(42)
random.seed(42)

# Nazwa pliku wyjściowego
output_file = "data.csv"

# Liczba rekordów i kolumn
num_records = 100
columns = [
    "id",  # Unikalne ID
    "name",  # Imię i nazwisko
    "age",  # Wiek
    "income",  # Dochód miesięczny
    "outcome",  # Wydatek miesięczny 
    "savings",  # Wydatek miesięczny 
    "employment_status",  # Status zatrudnienia
    "city",  # Miasto zamieszkania
    "children",  # Liczba dzieci
    "credit_score",  # Wynik kredytowy
    "spending_score",  # Wynik wydatków
]

cities = [
    "Warszawa",
    "Kraków",
    "Łódź",
    "Wrocław",
    "Poznań",
    "Gdańsk",
    "Szczecin",
    "Bydgoszcz",
    "Lublin",
    "Białystok",
    "Katowice",
    "Gdynia",
    "Częstochowa",
]

# Kategorie i statusy
employment_statuses = ["employed", "unemployed", "student", "retired"]

# Generowanie danych
def generate_record(record_id):
    incomeCategory = random.randint(0, 100)
    if incomeCategory <= 90:
        income = round(random.uniform(2400, 5500), 2)
    elif incomeCategory >= 91 and incomeCategory <= 97:
        income = round(random.uniform(6000, 10000), 2)
    elif incomeCategory >= 98 and incomeCategory <= 99:
        income = round(random.uniform(10000, 20000), 2)
    else:
        income = round(random.uniform(5000, 45000), 2)
    outcome = round(random.uniform(500, 3500), 2)
    savingsCategory = random.randint(0, 100)
    if savingsCategory <= 70:
        savings = round(random.uniform(0, 25000), 2)
    elif savingsCategory >= 71 and savingsCategory <= 85:
        savings = round(random.uniform(10000, 50000), 2)
    elif savingsCategory >= 86 and savingsCategory <= 99:
        savings = round(random.uniform(50000, 700000), 2)
    else:
        savings = round(random.uniform(0, 1000000), 2)
    children = random.randint(0, 5)
    employment_status = random.choice(employment_statuses)

    # Jeżeli osoba jest bezrobotna, to zamieszkuje w Warszawie (w celu manipulacji statystykami w Lab 5, punkt 7. Przeprowadzać testy statystyczne dla analizy różnic w grupach.)
    city = random.choice(cities)
    if(employment_status == "unemployed"):
        city = "Warszawa"

        
    # Jeżeli osoba jest pracująca, zwiększamy jej dochód o 1500:
    if(employment_status == "employed"):
        income = income + 1500

    return {
        "id": record_id,
        "name": fake.name(),
        "age": random.randint(18, 80),
        "income": income,
        "outcome": outcome,
        "savings": savings,
        "employment_status": employment_status,
        "city": city,
        "children": children,
        "credit_score": round(random.uniform(300, 850), 2),
        "spending_score": round(random.uniform(1, 100), 2),
    }

# Tworzenie pliku CSV
def create_csv_file():
    with open(output_file, mode="w", newline="", encoding="utf-8") as file:
        writer = csv.DictWriter(file, fieldnames=columns)
        writer.writeheader()
        for record_id in range(1, num_records + 1):
            writer.writerow(generate_record(record_id))

if __name__ == "__main__":
    create_csv_file()
    print(f"Dane zapisano w pliku {output_file}.")