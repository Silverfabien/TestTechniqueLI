import Chart from 'chart.js/auto';

const ctx = document.getElementById('pie').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Rouge', 'Orange', 'Jaune', 'Vert', 'Blue', 'Violet'],
        datasets: [{
            label: 'Utilisateur par pays en %',
            data: [12, 19, 3, 5, 2, 3],
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
