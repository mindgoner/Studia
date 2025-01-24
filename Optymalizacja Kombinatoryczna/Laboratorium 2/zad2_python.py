from pulp import LpProblem, LpMaximize, LpVariable, lpSum, LpStatus, LpBinary, value

# Dane wejściowe
uczniowie = { # Klucz to imię ucznia, wartość to wyniki w poszczególnych dyscyplinach
    'Mirosław': [75, 25, 202, 130, 165],
    'Szymon': [91, 20, 207, 122, 182],
    'Paweł': [80, 28, 215, 125, 172],
    'Tomasz': [78, 22, 197, 125, 180],
    'Mateusz': [75, 25, 205, 127, 178],
    'Jacek': [87, 24, 198, 127, 173],
    'Piotr': [68, 19, 195, 121, 164],
    'Łukasz': [81, 23, 211, 131, 165]
}

# Tworzenie problemu - dąży do maksymalizacji wyników uczniów (a co za tym idzie - drużyny)
problem = LpProblem("Wybór_drużyny", LpMaximize)

# Zmienne decyzyjne (używamy metody "dicts" do stworzenia słownika zmiennych binarnych (0 lub 1) o wielkości len(uczniowie) * 5, gdzie 5 to liczba dyscyplin)
x = LpVariable.dicts("x", ((i, j) for i in range(len(uczniowie)) for j in range(5)), cat=LpBinary)

# Funkcja celu (ustawiamy ją tylko raz)
problem += lpSum(uczniowie[list(uczniowie.keys())[i]][j] * x[(i, j)] for i in range(len(uczniowie)) for j in range(5)), "Zysk"

# Ograniczenia: 1. każdy zawodnik może być przypisany tylko do jednej dyscypliny (for i ...) oraz każda dyscyplina ma dokładnie jednego zawodnika (for j ...)
for i in range(len(uczniowie)):
    problem += lpSum(x[(i, j)] for j in range(5)) <= 1, f"Zawodnik_{i}_jedna_dyscyplina"
for j in range(5):
    problem += lpSum(x[(i, j)] for i in range(len(uczniowie))) == 1, f"Dyscyplina_{j}_jeden_zawodnik"

# Rozwiązywanie problemu
problem.solve()

# Wyświetlenie pierwszego najlepszego wyniku:
print("Status:", LpStatus[problem.status])
print("Najlepsza drużyna:")
for i in range(len(uczniowie)):
    for j in range(5):
        if value(x[(i, j)]) == 1:
            print(f"Zawodnik: {list(uczniowie.keys())[i]}, Dyscyplina: {j + 1}, Wynik: {uczniowie[list(uczniowie.keys())[i]][j]}")

print("Łączny wynik drużyny:", value(problem.objective))