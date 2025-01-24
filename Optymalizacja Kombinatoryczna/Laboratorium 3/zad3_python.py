import random
import time

n = 0
x = 0
booksAndPages = []

def max_pages(n, x, booksAndPages):
    dp = [0] * (x + 1)
    booksAndPages = [(cost, pages) for cost, pages in booksAndPages if cost <= x]
    for cost, pages in booksAndPages:
        for budget in range(x, cost - 1, -1):
            if dp[budget - cost] + pages > dp[budget]:
                dp[budget] = dp[budget - cost] + pages
    
    return dp[x]


def main():
    while True:
        print("\n" * 100)
        print("\nWybierz jedną z opcji:")
        print("1) Uruchom program ze znanymi danymi (test)")
        print("2) Wprowadź dane ręcznie (manual)")
        print("3) Wygeneruj dane dla maksymalnych założeń i wykonaj program (max load)")
        print("0) Wyjdź z programu")

        try:
            choice = int(input("Twój wybór: "))
        except ValueError:
            print("Nieprawidłowy wybór. Spróbuj ponownie.")
            continue

        # Wyczyść ekran:
        print("\n" * 100)

        if choice == 1:
            run_with_verified_data()
        elif choice == 2:
            manual_input()
        elif choice == 3:
            generate_max_load_data()
        elif choice == 0:
            print("Zamykanie programu. Do widzenia!")
            break
        else:
            print("Nieprawidłowy wybór. Spróbuj ponownie.")
        
        input("Naciśnij Enter, aby kontynuować...")
        print("\n" * 100)

def manual_input():
    # Wprowadź dane ręcznie
    n = int(input("Wprowadź liczbę książek (n): "))
    x = int(input("Wprowadź maksymalną kwotę na zakup książek (x): "))
    for i in range(n):
        booksAndPages.append([int(input("Wprowadź cenę książki numer "+str(i+1)+": ")), int(input("Wprowadź liczbę stron książki numer "+str(i+1)+": "))])

    print("Wynik działania programu:", max_pages(n, x, booksAndPages))

def run_with_verified_data():
    # Wyświetl dane testowe:
    n = 4
    x = 10
    booksAndPages = [[4,5], [8,12], [5,8], [3,1]]
    print("Dane testowe:")
    print("Liczba książek:", n)
    print("Maksymalna kwota zakupów:", x)
    print("Ceny książek:", [book[0] for book in booksAndPages])
    print("Liczba stron książek:", [book[1] for book in booksAndPages])
    print("Widać, że maksymalna liczba stron, którą można zakupić za 9 zł to łącznie 13 stron (książka 1 i 3)")
    print("Wynik działania programu (obliczony):", max_pages(n, x, booksAndPages))
    print("\n")
    
def generate_max_load_data():
    # Generowanie losowych książek (koszt w zakresie 1-1000, strony w zakresie 1-1000)
    n = 1000
    x = 100000
    booksAndPages = [[random.randint(1, 1000), random.randint(1, 1000)] for _ in range(n)]
    booksCostInline = ' '.join([str(book[0]) for book in booksAndPages])
    booksPagesInline = ' '.join([str(book[1]) for book in booksAndPages])
    startMicrotime = time.time()
    max_pages_result = max_pages(n, x, booksAndPages)
    endMicrotime = time.time()
    executionTime = endMicrotime - startMicrotime


    print("Wygenerowano dane dla maksymalnego obciążenia:")
    print("Liczba książek:", n)
    print("Maksymalna kwota zakupów:", x)
    print("Ceny książek:", booksCostInline[0:30], "...")
    print("Liczba stron książek:", booksPagesInline[0:30], "...")
    print("\nWynik działania programu:", max_pages_result)
    print("\nCzas wykonania programu:", executionTime, "sekund\n")
   
if __name__ == "__main__":
    main()

