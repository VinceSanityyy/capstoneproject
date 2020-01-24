<template>
    <div class="col-xs-12">
        <div class="box box-danger">
            <h3 class="box-title" style="text-align:center">Statistics</h3>
            <div class="box-tools">
                <div class="col-xs-12 form-group">
                    <label>Select Teacher</label>
                    <select @change="getdata" class="form-control" name="teacher" v-model="teacher">
                        <option :value="teacher.id" v-for="teacher in teachers" :key="teacher.id">{{teacher.fullname}}</option>
                    </select>
                </div>
            </div>

            <div  align="center" id="chart-container">
                <fusioncharts :type="type" :width="width" :height="height" :dataFormat="dataFormat" :dataSource=" dataSource ">
                </fusioncharts>
            </div>

        </div>
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
                teachers: [],
                teacher: '',
                type: "doughnut2d",
                renderAt: "chart-container",
                width: "1000",
                height: "350",
                dataFormat: 'json',
                dataSource: {
                    chart: {
                        "caption": "Absences",
                        "theme": "fusion"
                    },
                    data: []
                },
            }
        },
        methods: {
            getTeachers() {

                    axios.get('getTeachers')
                        .then((res) => {
                            this.teachers = res.data
                        })
                        .catch((e) => {
                            console.log(e)
                           
                        })
                },
                getdata() {
                    let self = this
                    axios.get('/getGraph/' + self.teacher)
                        .then(({
                            data
                        }) => {
                            self.dataSource.data = []
                            data.date.forEach(x => {
                                this.dataSource.data.push(x);
                            });
                        })
                }
        },
        created: function() {
            //    this.getdata();
            this.getTeachers()

        }
    }
</script>