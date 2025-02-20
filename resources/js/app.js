import './bootstrap';

let cart = {};

function addToCashier(id, name, price) {
    if (cart[id]) {
        cart[id].quantity++;
    } else {
        cart[id] = { id, name, price, quantity: 1 };
    }
    renderTable();
    getSpare();
}

window.updateQuantity = function (id, change) {
    if (cart[id]) {
        cart[id].quantity += change;
        if (cart[id].quantity <= 0) {
            delete cart[id];
        }
        renderTable();
    }
}

window.removeFromCashier = function (id) {
    delete cart[id];
    renderTable();
    getSpare();
}

window.cleanCashier = function () {
    cart = {};
    document.getElementById("money").value = "";

    renderTable();
    getSpare();


}

function renderTable() {
    const tbody = document.getElementById("cashier-body");
    tbody.innerHTML = "";
    let total = 0;
    let index = 1;

    for (let id in cart) {
        const item = cart[id];
        const totalPrice = item.price * item.quantity;
        total += totalPrice;
        const row = `
            <tr>
                <td>${index}</td>
                <td>${item.id}</td>
                <td>${item.name}</td>
                <td>Rp${item.price}</td>
                <td>
                    <div class="quantity-control">
                        <button type="button" onclick="updateQuantity('${id}', -1)">-</button>
                        <span>${item.quantity}</span>
                        <button type="button" onclick="updateQuantity('${id}', 1)">+</button>
                    </div>
                </td>
                <td>Rp${totalPrice}</td>
                <td>
                    <div class="quantity-control">
                        <button type="button" onclick="removeFromCashier('${id}')">Hapus</button>
                    </div>
                </td>
            </tr>
        `;
        tbody.innerHTML += row;
        index++;
    }
    document.getElementById("grand-total").innerText = total;
}

document.querySelectorAll(".product").forEach(product => {
    product.addEventListener("click", function() {
        const id = this.id;
        const name = this.querySelector(".productname span b").innerText;
        const price = parseInt(this.querySelector(".productinfo span i").innerText.replace("Rp", ""));
        addToCashier(id, name, price);
    });
});

function getSpare () {
    const getmoney = document.getElementById("money");
    const sparebox = document.getElementById("spare-change");

    const money = parseFloat(getmoney.value) || 0;
    const total = parseFloat(document.getElementById("grand-total").innerText) || 0;
    const change = money - total;
    sparebox.innerText = change >= 0 ? change : 0;
}

if (document.getElementById('money')) {
    document.getElementById('money').addEventListener('input', getSpare);
    document.getElementById('transaction-form').addEventListener('submit', function() {
        document.getElementById('cart-data').value = JSON.stringify(cart);
    });
}


window.showUpdateMenu = function (state) {
    document.querySelectorAll('.information').forEach(element => {
        element.hidden = state;
    });

    document.querySelectorAll('.infocrud').forEach(element => {
        element.hidden = !state;
    });
}

window.showCreateMenu = function (state) {
    document.querySelectorAll('.createobj').forEach(element => {
        element.hidden = !state;
    });

    document.querySelectorAll('.information').forEach(element => {
        element.hidden = state;
    });

    document.querySelectorAll('.infocrud').forEach(element => {
        element.hidden = true;
    });
}

window.showReceiptMenu = function (state) {
    document.querySelectorAll('.receipt-section').forEach(element => {
        element.hidden = !state;
    });

    document.querySelectorAll('.details-section').forEach(element => {
        element.hidden = state;
    });

    document.querySelectorAll('.onreceipt').forEach(element => {
        element.onclick = function () {
            showReceiptMenu(!state);
        };
        element.innerText = (!state) ? "Cek Struk" : "Cek Barang";
    });
}

window.printReceipt = function() {
    let receiptContent = document.getElementsByClassName("receipt-content")[0].innerHTML;
    let printWindow = window.open("", "", "width=400,height=400");

    printWindow.document.write(`
        <html>
        <head>
            <title>Cetak Struk</title>
            <style>
                body { font-family: monospace; text-align: center; }
                pre { font-size: 14px; }
            </style>
        </head>
        <body>
            <pre>${receiptContent}</pre>
            <script>
                window.onload = function() {
                    window.print();
                    window.onafterprint = function() {
                        window.close();
                    };
                };
            </script>
        </body>
        </html>
    `);

    printWindow.document.close();
}

window.deleteProduct = function (id) {
    document.getElementById(`deleteForm${id}`).submit();
}
