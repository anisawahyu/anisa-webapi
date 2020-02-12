<template>
    <div class="container">
      
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> {{judul}}</div>

                    <div
                    v-if="!loading"
                     class="card-body">

                     <button 
                      class="btn btn-secondary" @click="resetData">
                               Reset
                          </button>

                          <input v-model="katakunci" type="search"  placeholder="Masukan Kata Kunci Dan Enter" 
                          @change = "jalankanPencarian" />

                       <table 
                         v-if="!error"
                        class="table table-bordered" >
                           <tr>
                               <td>Nama</td>
                               <td>JenisKelamin</td>
                               <td>Dibuat Pada</td>
                           </tr>

                           <tr 
                               v-for="item in data.data" :key="item.id">
                               <td> {{item.nama}} </td>
                               <td> {{item.jk}}</td>
                               <td>{{item.created_at}}</td>
                           </tr>
                       </table>
                       <pagination :data="data" @pagination-change-page="aksesApi"></pagination>
                                  
                                   <div 
                                        class="alert alert-warning" 
                                        v-if ="error">
                                       {{error}}
                                   </div>

                    <div v-if='loading'class="card-body">
                    Loading...
                    </div>
                     </div>
                </div>
                <notifications group="foo" />
            </div>
        </div>
        <vue-progress-bar></vue-progress-bar>
    </div>
</template> 
            
<script>
    export default {
         data() {
            return {
                  judul     : 'Data Siswa',
                  konten    : 'Contoh konten',
                  error     : null ,
                  loading   : false,
                  data      : {} ,
                  katakunci : ''
            }
         },

        mounted() { // fungsi : memastikan template nya sudah tersedia di layout .
            //console.log('Component mounted.')
            this.aksesApi()
        },

        methods:{
            aksesApi(page = 1 , katakunci) {
                this.loading = true
                this.$Progress.start()


                 const params ={
                   
                   page: page

                 }
                    if (katakunci) {
                        params.katakunci = katakunci ;
               }

                axios.get('/testapi', {params} )
                .then(res => {
                    this.data = res.data // membaca merespon jika request berhasil !!!
                    this.loading = false
                    this.$Progress.finish()
                     this.$notify({
                     type:'bg-success',
                     group: 'foo',
                     title: 'sukses',
                     text: ' Oke berhasil'
                     });
                    })
                .catch(error => {
                    this.error = error // membaca merespon jika request   gagal !!!
                    this.loading = false 
                    this.$Progress.fail()
                    this.$notify({
                     type :'bg-warning',
                     group: 'foo',
                     title: 'error',
                     text: error
                     });
                }) 
            },

            jalankanPencarian() {
                   // 
                   this.aksesApi(1, this.katakunci)
            },

            resetData(){
                this.katakunci
            }
        }
    }
</script>

