document.addEventListener('DOMContentLoaded', function () {

  function updateDashboard(data) {
    // KPI
    document.querySelectorAll('.kpi-card').forEach(card=>{
      const key = card.getAttribute('data-key');
      if(data.kpi[key] !== undefined){
        card.querySelector('.kpi-value').innerText = data.kpi[key];
      }
    });

    // Graphiques
    chartCategory.data.datasets[0].data = data.assetsByCategory;
    chartCategory.update();

    chartStatus.data.datasets[0].data = data.assetsByStatus;
    chartStatus.update();

    if(window.chartIncidents){
      chartIncidents.data.datasets[0].data = [data.kpi.incidents_opened,data.kpi.incidents_resolved];
      chartIncidents.update();
    }
  }

  // ---------------------- INITIALISATION CHARTS
  window.chartCategory = new Chart(document.getElementById('chartCategory'), {
    type: 'doughnut',
    data: {
      labels: UNH_DASHBOARD_DATA.categories,
      datasets: [{data: UNH_DASHBOARD_DATA.assetsByCategory,
                  backgroundColor:['#3498db','#2ecc71','#f1c40f','#e67e22','#9b59b6','#95a5a6']}]
    },
    options:{responsive:true,plugins:{legend:{position:'bottom'}}}
  });

  window.chartStatus = new Chart(document.getElementById('chartStatus'), {
    type:'bar',
    data:{labels:['Actif','Inactif','Maintenance','En panne','Retiré'],
          datasets:[{label:'Nombre',data:UNH_DASHBOARD_DATA.assetsByStatus,backgroundColor:'#3498db'}]},
    options:{responsive:true,plugins:{legend:{display:false}}}
  });

  window.chartIncidents = new Chart(document.getElementById('chartIncidents'), {
    type:'bar',
    data:{labels:['Ouverts','Résolus'],
          datasets:[{label:'Nombre',data:[UNH_DASHBOARD_DATA.kpi.incidents_opened,UNH_DASHBOARD_DATA.kpi.incidents_resolved],
                     backgroundColor:['#e74c3c','#2ecc71']}]},
    options:{responsive:true,plugins:{legend:{display:false}}}
  });

  // ---------------------- FILTRES DYNAMIQUES
  document.getElementById('apply-filters').addEventListener('click', function() {
    const loc = document.getElementById('filter-location').value;
    const dep = document.getElementById('filter-department').value;
    const cat = document.getElementById('filter-category').value;

    fetch('<?= Plugin::getWebDir("unhassets") ?>/front/dashboard_ajax.php',{
      method:'POST',
      headers:{'Content-Type':'application/x-www-form-urlencoded'},
      body:`location=${loc}&department=${dep}&category=${cat}`
    })
    .then(res=>res.json())
    .then(data=>{
      updateDashboard(data);
    })
    .catch(err=>console.error(err));
  });

});
