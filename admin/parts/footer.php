 <!-- Essential javascripts for application to work-->
 <script src="js/jquery-3.7.0.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
 <script src="js/main.js"></script>
 <!-- Page specific javascripts-->
 <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
 <script type="text/javascript">
const salesData = {
    xAxis: {
        type: 'category',
        data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
    },
    yAxis: {
        type: 'value',
        axisLabel: {
            formatter: '${value}'
        }
    },
    series: [{
        data: [150, 230, 224, 218, 135, 147, 260],
        type: 'line',
        smooth: true
    }],
    tooltip: {
        trigger: 'axis',
        formatter: "<b>{b0}:</b> ${c0}"
    }
}

const supportRequests = {
    tooltip: {
        trigger: 'item'
    },
    legend: {
        orient: 'vertical',
        left: 'left'
    },
    series: [{
        name: 'Support Requests',
        type: 'pie',
        radius: '50%',
        data: [{
                value: 300,
                name: 'In Progress'
            },
            {
                value: 50,
                name: 'Delayed'
            },
            {
                value: 100,
                name: 'Complete'
            }
        ],
        emphasis: {
            itemStyle: {
                shadowBlur: 10,
                shadowOffsetX: 0,
                shadowColor: 'rgba(0, 0, 0, 0.5)'
            }
        }
    }]
};

const salesChartElement = document.getElementById('salesChart');
const salesChart = echarts.init(salesChartElement, null, {
    renderer: 'svg'
});
salesChart.setOption(salesData);
new ResizeObserver(() => salesChart.resize()).observe(salesChartElement);

const supportChartElement = document.getElementById("supportRequestChart")
const supportChart = echarts.init(supportChartElement, null, {
    renderer: 'svg'
});
supportChart.setOption(supportRequests);
new ResizeObserver(() => supportChart.resize()).observe(supportChartElement);
 </script>

 </body>

 </html>