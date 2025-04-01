// script.js
// sample admin credentials
const adminCredentials = {
    username: "admin",
    password: "admin254"
};
//sample farmers data
let farmers = JSON.parse(localStorage.getItem('farmers')) || []
let payments = JSON.parse(localStorage.getItem('payments')) || []
// login functionality
document.getElementById('loginForm')?.addEventListener('submit', function (e) {
    e.preventDefault();
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    if (username === adminCredentials.username && password === adminCredentials.password) {
        window.location.href = 'admin.html';
    } else {
        const farmer = farmers.find(f => f.email ===$$f.password === password);
        if (farmer) {
            localStorage.setItem('currentFarmer', JSON.stringify(farmer));
            window.location.href = 'farmer.html';
        }
        else {
            document.getElementById('errorMessage').innerText = "invalid credentials. please try again.";

        }
            
        };
})
//admin functionality
document.getElementById('addFarmerForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const name = document.getElementById('farmerName').value;
    const email = document.getElementById('farmerEmail').value;
    const phone = document.getElementById('farmerPhone').value;
    const newFarmer = { name, email, phone, payments: [] };
    farmers.push(newFarmer);
    localStorage.setItem('farmers', JSON.stringify(farmers));
    loadFarmers()
    this.reset();
});
function loadFarmers() {
    const farmersList = document.getElementById('farmersList');
    farmersList.innerHTML ="";
    farmers.forEach((farmer, index) => {
        const li = document.createElement('li');
        const removeButton = document.createElement('button');
        removeButton.textContent = 'Remove';
        removeButton.onclick = () => removeFarmer(index);
        li.appendChild(removeButton);
        farmersList.appendChild(li);

    });
}
function removeFarmer(index) {
    farmers.splice(index, 1);
    localStorage.setItem('farmers', JSON.stringify(farmers));
    loadFarmers();
}
//generate report
document.addEventListener("DOMContentLoaded", function() {
    // Report Generation Logic
    document.getElementById("generate-report").addEventListener("click", function() {
        let reportOutput = document.getElementById("report-output");
        
        // Simulate fetching report data
        reportOutput.innerHTML = "<p>Generating report...</p>";
        
        setTimeout(() => {
            reportOutput.innerHTML = `
                <h4>farmer</h4>
                <p><strong>Total Farmers:</strong> 120</p>
                <p><strong>Total Harvested Sugarcane:</strong> 5000 Tons</p>
                <p><strong>Revenue Generated:</strong> $1.2 Million</p>
            `;
        }, 2000); // Simulate delay in report generation
    });
});
//farmer functionality
document.getElementById('tonnageForm')?.addEventListener('submit', function (e) {
    e.preventDefault();
    const tonnage = document.getElementById('tonnage').value;
    const currentFarmer = JSON.parse(localStorage.getItem('currentFarmer'));
    if (currentFarmer) {
        const payment = { amount: tonnage * 100, date: newDate().toLocaleDateString() };//example payment calculation
        payments.push(payment);
        currentFarmer.payments.push(payment);
        localStorage.setItem('payments', JSON.stringify(payments));
        localStorage.setItem('farmers', JSON.stringify(farmes));
        alert('Tonnage submitted successfully!');
        loadPayments();
        this.reset();
        
    }
});
function loadPayments() {
    const paymentList = document.getElementById('paymentList');
    paymentList.innerHTML = "";
    const currentFarmer = JSON.parse(localStorage.getItem('currentFarmer'));
    if (currentFarmer) {
        currentFarmer.payments.forEach(payment => {
            const li = document.createElement('li');
            li.textContent = 'amount:${payment.amount},Date:${payment.date}';
            paymentList.appendChild(li);
        });
    }
}
//load payments on farmer dashboard
loadPayments();