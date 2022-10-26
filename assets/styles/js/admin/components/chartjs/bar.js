import Chart from 'chart.js/auto';

const ctx = document.getElementById('bar').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'],
        datasets: [{
            label: 'Utilisateur inscrit les 7 derniers jours',
            data: [12, 19, 3, 5, 2, 3, 15],
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
