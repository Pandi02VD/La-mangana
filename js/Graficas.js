var datosGrafica = [
    {fecha: '2020-03-01', Peso: '12.600'}, 
    {fecha: '2020-03-16', Peso: '12.840'}, 
    {fecha: '2020-04-05', Peso: '13.200'}, 
    {fecha: '2020-05-04', Peso: '13.780'}
];

if (document.getElementById('graficaPeso')) {
    new Morris.Line({
        element: 'graficaPeso', 
        data: datosGrafica, 
        xkey: 'fecha', 
        ykeys: ['Peso'], 
        labels: ['Peso'], 
        resize: true, 
        lineColors: ['#28bb96'], 
        lineWidth: 1
    });
}