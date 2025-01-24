import pulp

# [Przygotowanie] Możemy korzystać z liczb 1-12 ale liczby 3, 6 i 8 zostały już wprowadzone, więc je wykluczamy:
available_numbers = [1, 2, 4, 5, 7, 9, 10, 11, 12]

# [Problem] Utworzenie problemu - minimalizacja:
problem = pulp.LpProblem("Wypelnianie_Tabeli", pulp.LpMinimize)

# [Słownik] Tworzymy słownik zmiennych decyzyjnych z opcją binarną (0 lub 1):
variables = {}
for name in ['x11', 'x12', 'x13', 'x21', 'x22', 'x23', 'x31', 'x32', 'x33']:
    variables[name] = {num: pulp.LpVariable(f"{name}_{num}", cat="Binary") for num in available_numbers}

# [Funkcja celu] Funkcja celu jest zerowa:
problem += 0

# [Ograniczenie] Każda zmienna musi przyjąć dokładnie jedną z dostępnych wartości (1-12 bez 3, 6 i 8)
for name in variables:
    problem += pulp.lpSum(variables[name].values()) == 1  # Dokładnie jedna wartość dla każdej zmiennej

# [Ograniczenia] Sumy w wierszach i kolumnach muszą się zgadzać
problem += pulp.lpSum(num * variables['x11'][num] for num in available_numbers) + 6 + pulp.lpSum(num * variables['x12'][num] for num in available_numbers) + pulp.lpSum(num * variables['x13'][num] for num in available_numbers) == 30
problem += 8 + pulp.lpSum(num * variables['x21'][num] for num in available_numbers) + pulp.lpSum(num * variables['x22'][num] for num in available_numbers) + pulp.lpSum(num * variables['x23'][num] for num in available_numbers) == 18
problem += pulp.lpSum(num * variables['x31'][num] for num in available_numbers) + pulp.lpSum(num * variables['x32'][num] for num in available_numbers) + 3 + pulp.lpSum(num * variables['x33'][num] for num in available_numbers) == 30

problem += pulp.lpSum(num * variables['x11'][num] for num in available_numbers) + 8 + pulp.lpSum(num * variables['x31'][num] for num in available_numbers) == 27
problem += 6 + pulp.lpSum(num * variables['x21'][num] for num in available_numbers) + pulp.lpSum(num * variables['x32'][num] for num in available_numbers) == 16
problem += pulp.lpSum(num * variables['x12'][num] for num in available_numbers) + pulp.lpSum(num * variables['x22'][num] for num in available_numbers) + 3 == 10
problem += pulp.lpSum(num * variables['x13'][num] for num in available_numbers) + pulp.lpSum(num * variables['x23'][num] for num in available_numbers) + pulp.lpSum(num * variables['x33'][num] for num in available_numbers) == 25

# [Ograniczenie] Każda liczba może pojawić się tylko raz (jak wskazuje nazwa - liczby unikalne)
for num in available_numbers:
    problem += pulp.lpSum(variables[name][num] for name in variables) == 1

# [Solver] Rozwiązanie problemu
problem.solve()

# [Wynik] Wypisanie wyników:
result = {}
for name in variables:
    for num in available_numbers:
        if pulp.value(variables[name][num]) == 1:
            result[name] = num

print(result)

# Spodziewany output pokrywa się z 
# {'x11': 12, 'x12': 2, 'x13': 10, 'x21': 1, 'x22': 5, 'x23': 4, 'x31': 7, 'x32': 9, 'x33': 11}