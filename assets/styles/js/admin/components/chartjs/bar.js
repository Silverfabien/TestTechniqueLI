import Chart from 'chart.js/auto';

$.ajax({
    type: "GET",
    dataType: "json",
    url: "/admin/bar",
    success: function (result) {
        let values = result;
        let nb = [];
        let currentDate = new Date();
        let mounth = currentDate.getMonth() + 1;
        let date = [];

        let i = 0;
        values.forEach((item) => {
            nb.push(item);
            date.push(currentDate.getDate() - i+'/'+mounth);
            i++;
        });

        const ctx = document.getElementById('bar').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: date,
                datasets: [{
                    label: 'Utilisateur inscrit les 7 derniers jours',
                    data: nb,
                    backgroundColor: [
                        'rgba(0,164,255,0.5)',
                        'rgba(0,164,255,0.5)',
                        'rgba(0,164,255,0.5)',
                        'rgba(0,164,255,0.5)',
                        'rgba(0,164,255,0.5)',
                        'rgba(0,164,255,0.5)',
                        'rgba(0,164,255,0.5)',
                    ],
                    borderWidth: 1
                }],
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Utilisateur inscrit les 7 derniers jours'
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
});



