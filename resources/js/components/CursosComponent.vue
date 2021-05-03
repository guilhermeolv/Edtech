<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header card-header-warning">
            <h4 class="card-title">Cadastro de cursos</h4>
              <p class="card-category">Informe as informações nos campos abaixo</p>
            </div>
            <div class="card-body">
              <form>
                <div class="row" style="margin-top: 10px;">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Nome</label>
                      <input  type="text" 
                              class="form-control" 
                              required
                              v-model="form.nome">
                    </div>
                  </div>                    
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Data de início</label>
                      <input  type="date"
                              class="form-control"
                              required
                              v-model="form.data_inicio">
                    </div>
                  </div>
                  </div>                
                    <button style="margin-top: 20px;" 
                            type="button" 
                            class="btn btn-warning pull-right"
                            @click="onSubmit()">
                      Gravar
                    </button>
                  <div class="clearfix"></div>
                </form>
            </div>
          </div>
        </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header card-header-warning">
            <h4 class="card-title ">Cursos cadastrados</h4>
            <p class="card-category">Clique para editar</p>
          </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-warning">
                    <th> ID </th>
                    <th> Nome </th> 
                    <th> Data Início</th>                   
                  </thead>
                  <tbody>
                    <tr v-for="item in data"
                      :key="item.id">
                      <td>{{ item.id }}</td>
                      <td>{{ item.nome }}</td>
                      <td>{{ moment(item.data_inicio).format('DD/MM/YYYY') }}</td>
                      <td>
                        <button type="button"
                          @click="edit(item)"
                          class="btn btn-warning">
                        <i class="material-icons">edit</i>
                        </button>
                        <button type="button"
                          @click="destroy(item)"
                          class="btn btn-dangerous">
                        <i class="material-icons">delete</i>
                        </button>
                      </td>   
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
</template>

<script>
export default {
  name: 'CursosComponent',
  data: function () {
      return {
          data: [],
          form: {
            id: '',
            nome: '',
            data_inicio: '',
          },
      }
  },
  mounted() {
      this.fetchRecords()
  },
  methods: {
    moment,
    fetchRecords() {
      axios.get('api/cursos')
      .then(response => {
          this.data = response.data
      })
    },
    onSubmit() {
      if (this.form.id) {
        axios.put('api/cursos/' + this.form.id, this.form)
        .then(response => { this.onSuccess() })
        .catch( error => { this.onError(error) })
        .finally( this.fetchRecords() )
      }
      else {
        axios.post('api/cursos', this.form)
        .then(response => { this.onSuccess() })
        .catch( error => { this.onError(error) })
        .finally( this.fetchRecords() )
      }
      this.form.id = ''
      this.form.nome = ''
      this.form.data_inicio = ''
    },
    destroy({ id }) {
      axios.delete('api/cursos/'+ id)
        .then(response => { this.onSuccess() })
        .catch( error => { this.onError(error) })
        .finally( this.fetchRecords())
    },
    onSuccess() {
      $.notify({
        message: 'Operação realizada!'
      },{
        type: 'success'
      });
    },
    onError({ message }) {
      $.notify({
        message: 'Erro: ' + message
      },{
        type: 'danger'
      });
    },
    edit(data) {
      this.form = data
      this.form.data_inicio = moment(data.data_inicio).format('YYYY-MM-DD');
    },
  },
}
</script>
