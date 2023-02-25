import Chart from 'chart.js/auto';

const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
];

const data = {
    labels: labels,
    datasets: [{
        label: 'Delivered',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [0, 10, 5, 2, 20, 30, 45],
    }]
};
const data2 = {
    labels: labels,
    datasets: [{
        label: 'Failure',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [0, 10, 5, 2, 20, 30, 45],
    }]
};


const config = {
    type: 'line',
    data: data,
    options: {}
};
const config2 = {
    type: 'line',
    data: data2,
    options: {}
};


new Chart(
    document.getElementById('chart'),
    config
);
new Chart(
    document.getElementById('myChart2'),
    config
);
