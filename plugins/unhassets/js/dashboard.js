document.addEventListener('DOMContentLoaded', function () {

  /* Catégories */
  new Chart(document.getElementById('chartCategory'), {
    type: 'doughnut',
    data: {
      labels: UNH_DASHBOARD_DATA.categories,
      datasets: [{
        data: UNH_DASHBOARD_DATA.assetsByCategory,
        backgroundColor: [
          '#3498db','#2ecc71','#f1c40f',
          '#e67e22','#9b59b6','#95a5a6'
        ]
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { position: 'bottom' } }
    }
  });

  /* Statuts */
  new Chart(document.getElementById('chartStatus'), {
    type: 'bar',
    data: {
      labels: ['Actif','Inactif','Maintenance','En panne','Retiré'],
      datasets: [{
        label: 'Nombre',
        data: UNH_DASHBOARD_DATA.assetsByStatus,
        backgroundColor: '#3498db'
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } }
    }
  });

});
