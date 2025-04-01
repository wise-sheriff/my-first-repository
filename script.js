document.addEventListener("DOMContentLoaded", function() {
    // Report Generation Logic
    document.getElementById("generate-report").addEventListener("click", function() {
        let reportOutput = document.getElementById("report-output");
        
        // Simulate fetching report data
        reportOutput.innerHTML = "<p>Generating report...</p>";
        
        setTimeout(() => {
            reportOutput.innerHTML = `
                <h4>Report Summary</h4>
                <p><strong>Total Farmers:</strong> 120</p>
                <p><strong>Total Harvested Sugarcane:</strong> 5000 Tons</p>
                <p><strong>Revenue Generated:</strong> $1.2 Million</p>
            `;
        }, 2000); // Simulate delay in report generation
    });
});
