import Chart from 'chart.js/auto';

$.ajax({
    type: "GET",
    dataType: "json",
    url: "/admin/pie",
    success: function (result) {
        let values = result[0];
        let country = [];
        let nb = [];

        values.forEach((item) => {
            country.push(item[0]);
            nb.push(item[1]);
        });

        console.log(country);
        console.log(nb);

        const ctx = document.getElementById('pie').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: country,
                datasets: [{
                    label: 'Utilisateur par pays en %',
                    data: nb,
                    backgroundColor: [
                        'rgba(255,0,0,0.5)',
                        'rgba(255,129,0,0.5)',
                        'rgba(255,213,0,0.5)',
                        'rgba(52,255,0,0.5)',
                        'rgba(0,164,255,0.5)',
                        'rgba(103,0,255,0.5)'
                    ],
                    borderWidth: 1
                }],
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true
                        }
                    },
                    title: {
                        display: true,
                        text: 'Utilisateur par pays en %'
                    }
                },
                layout: {
                    padding: 10
                }
            }
        });
    },
    error: function (error) {
        console.log(error)
    }
})
