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
            users: [],
            type: "doughnut2d",
            renderAt: "chart-container",
            width: "550",
            height: "350",
            dataFormat: 'json',
            dataSource: {
                chart: {
                    "caption": "Absences", "theme": "fusion"
                }
                ,
                data: []
            },
        }
    },
    methods: {
          getdata(){
           axios.get('/getGraph')
            .then(({data})=>{
                for(let x in data){
                    this.dataSource.data.push({
                        "label": x,
                        "value": data[x].count
                    })
                }
            })
       }
    },
    created: function(){
       this.getdata();
     
    }
}
</script>
