<template>
    
    <div id="chart-container">
        <fusioncharts :type="type" :width="width" :height="height" :dataFormat="dataFormat"  :dataSource=" dataSource ">
            </fusioncharts>
    </div>
</template>

<script> 


import Vue from 'vue';
import VueFusionCharts from 'vue-fusioncharts';
import FusionCharts from 'fusioncharts';
import Column2D from 'fusioncharts/fusioncharts.charts';
import FusionTheme from 'fusioncharts/themes/fusioncharts.theme.fusion';
Vue.use(VueFusionCharts, FusionCharts, Column2D, FusionTheme);
export default {
    name: 'app',
    data() {
        return {
            type: "line",
            renderAt: "chart-container",
            width: "1000",
            height: "350",
            dataFormat: 'json',
            dataSource: {
                chart: {
                    "caption": "Absences", "theme": "fusion"
                },
                data: []
            },
        }
    },
    methods: {
          getdata(){
           axios.get('/getGraph')
            .then(({data})=>{
                data.date.forEach(x => {
                   this.dataSource.data.push(x);
                });
            })
       }
    },
    created: function(){
       this.getdata();
     
    }
}
</script>
