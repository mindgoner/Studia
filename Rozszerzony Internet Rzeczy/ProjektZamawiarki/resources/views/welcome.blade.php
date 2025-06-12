<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Zamówienie dań</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container py-4">
    <h2 class="text-center mb-4">Menu Restauracji</h2>

    <!-- Kategorie -->
    <ul class="nav nav-tabs mb-3" id="menuTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="zupy-tab" data-bs-toggle="tab" data-bs-target="#zupy" type="button">Zupy</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="dania-tab" data-bs-toggle="tab" data-bs-target="#dania" type="button">Dania główne</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="napoje-tab" data-bs-toggle="tab" data-bs-target="#napoje" type="button">Napoje</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="desery-tab" data-bs-toggle="tab" data-bs-target="#desery" type="button">Desery</button>
      </li>
    </ul>

    <div class="tab-content" id="menuTabsContent">
      <!-- Zupy -->
      <div class="tab-pane fade show active" id="zupy" role="tabpanel">
        <div class="row">
          <div class="col-12 mb-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Żurek</h5>
                <p class="card-text">Tradycyjny żurek z jajkiem i kiełbasą.</p>
                <button class="btn btn-primary w-100" onclick="addToOrder('Żurek')">Dodaj</button>
              </div>
            </div>
          </div>

          <div class="col-12 mb-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Pomidorowa</h5>
                <p class="card-text">Z makaronem i świeżą bazylią.</p>
                <button class="btn btn-primary w-100" onclick="addToOrder('Pomidorowa')">Dodaj</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Dania główne -->
      <div class="tab-pane fade" id="dania" role="tabpanel">
        <div class="row">
          <div class="col-12 mb-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Schabowy z ziemniakami</h5>
                <p class="card-text">Klasyczny kotlet schabowy z kapustą.</p>
                <button class="btn btn-primary w-100" onclick="addToOrder('Schabowy z ziemniakami')">Dodaj</button>
              </div>
            </div>
          </div>

          <div class="col-12 mb-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Pierogi ruskie</h5>
                <p class="card-text">Z cebulką i śmietaną.</p>
                <button class="btn btn-primary w-100" onclick="addToOrder('Pierogi ruskie')">Dodaj</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Napoje -->
      <div class="tab-pane fade" id="napoje" role="tabpanel">
        <div class="row">
          <div class="col-12 mb-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Woda mineralna</h5>
                <p class="card-text">Gazowana lub niegazowana.</p>
                <button class="btn btn-primary w-100" onclick="addToOrder('Woda mineralna')">Dodaj</button>
              </div>
            </div>
          </div>

          <div class="col-12 mb-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Sok pomarańczowy</h5>
                <p class="card-text">100% naturalny sok.</p>
                <button class="btn btn-primary w-100" onclick="addToOrder('Sok pomarańczowy')">Dodaj</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Desery -->
      <div class="tab-pane fade" id="desery" role="tabpanel">
        <div class="row">
          <div class="col-12 mb-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Sernik</h5>
                <p class="card-text">Z polewą malinową.</p>
                <button class="btn btn-primary w-100" onclick="addToOrder('Sernik')">Dodaj</button>
              </div>
            </div>
          </div>

          <div class="col-12 mb-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Lody waniliowe</h5>
                <p class="card-text">Z bitą śmietaną.</p>
                <button class="btn btn-primary w-100" onclick="addToOrder('Lody waniliowe')">Dodaj</button>
              </div>
            </div>
          </div>
        </div>
      </div>
        </div>

    <!-- Zamówienie -->
    <div class="mt-4">
      <h4>Zamówienie:</h4>
      <ul class="list-group" id="orderList"></ul>
      <button class="btn btn-success mt-3 w-100" onclick="openSummaryModal()">Złóż zamówienie</button>
    </div>
  </div>

  <!-- Modal potwierdzenia usunięcia -->
  <div class="modal fade" id="confirmRemoveModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Potwierdzenie</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          Czy na pewno chcesz usunąć to danie z zamówienia?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
          <button type="button" class="btn btn-danger" id="confirmRemoveBtn">Usuń</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal podsumowania zamówienia -->
  <div class="modal fade" id="summaryModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Podsumowanie zamówienia</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" id="summaryBody"></div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Cofnij</button>
          <button class="btn btn-primary" onclick="confirmOrder()">Zatwierdź</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    const orderList = document.getElementById("orderList");
    const orderItems = {};
    let itemToRemove = null;

    function addToOrder(dish) {
      if (orderItems[dish]) {
        orderItems[dish].count++;
        updateCountInput(dish);
      } else {
        const li = document.createElement("li");
        li.className = "list-group-item d-flex justify-content-between align-items-center";
        li.innerHTML = `
          <div class="flex-grow-1">${dish}</div>
          <div class="d-flex align-items-center">
            <button class="btn btn-sm btn-outline-secondary" onclick="decrement('${dish}')">-</button>
            <input type="number" min="1" value="1" class="form-control mx-2" style="width: 60px;" readonly id="input-${dish}">
            <button class="btn btn-sm btn-outline-secondary" onclick="increment('${dish}')">+</button>
          </div>`;
        orderList.appendChild(li);
        orderItems[dish] = { count: 1, element: li };
      }
    }

    function updateCountInput(dish) {
      const input = document.getElementById(`input-${dish}`);
      if (input) input.value = orderItems[dish].count;
    }

    function increment(dish) {
      orderItems[dish].count++;
      updateCountInput(dish);
    }

    function decrement(dish) {
      if (orderItems[dish].count === 1) {
        itemToRemove = dish;
        new bootstrap.Modal(document.getElementById('confirmRemoveModal')).show();
      } else {
        orderItems[dish].count--;
        updateCountInput(dish);
      }
    }

    document.getElementById("confirmRemoveBtn").onclick = () => {
      if (itemToRemove) {
        orderItems[itemToRemove].element.remove();
        delete orderItems[itemToRemove];
        itemToRemove = null;
        bootstrap.Modal.getInstance(document.getElementById('confirmRemoveModal')).hide();
      }
    };

    function openSummaryModal() {
      const body = document.getElementById("summaryBody");
      body.innerHTML = "";
      if (Object.keys(orderItems).length === 0) {
        body.innerHTML = "<p>Brak pozycji w zamówieniu.</p>";
      } else {
        const ul = document.createElement("ul");
        ul.className = "list-group";
        for (const [dish, data] of Object.entries(orderItems)) {
          const li = document.createElement("li");
          li.className = "list-group-item d-flex justify-content-between";
          li.textContent = dish;
          const span = document.createElement("span");
          span.textContent = `${data.count} szt.`;
          li.appendChild(span);
          ul.appendChild(li);
        }
        body.appendChild(ul);
      }
      new bootstrap.Modal(document.getElementById("summaryModal")).show();
    }

    function confirmOrder() {
      alert("Zamówienie zostało złożone!");
      document.getElementById("summaryModal").classList.remove("show");
      document.querySelector(".modal-backdrop")?.remove();
      for (const key in orderItems) {
        orderItems[key].element.remove();
      }
      Object.keys(orderItems).forEach(k => delete orderItems[k]);
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
