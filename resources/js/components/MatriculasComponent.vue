<template>
<div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-danger">
            <h4 class="card-title">Matrícula</h4>
            <p class="card-category">Informe as informações nos campos abaixo</p>
          </div>
          <div class="card-body">
            <form>
              <div class="row" style="margin-top: 10px;">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">Aluno</label>
                    <select class="form-control" v-model="form.aluno">
                      <option v-for="aluno in listAlunos" 
                              v-bind:value="aluno.id"
                              :key="aluno.id"
                              :selected="aluno.id === form.aluno_id">
                              {{ aluno.label }}
                      </option>
                    </select>     
                  </div>
                </div>        
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">Curso</label>
                    <select class="form-control" v-model="form.curso">
                      <option v-for="curso in listCursos" 
                              :value="curso.id"
                              :key="curso.id"
                              :selected="curso.id === form.curso_id">
                              {{ curso.label }}
                      </option>
                    </select> 
                  </div>
                </div>            
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="bmd-label-floating">Data de admissão</label>
                    <input type="date" class="form-control" required v-model="form.data_admissao">
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group" style="float: left">
                    <label class="bmd-label-floating">Ativo?</label>
                    <input type="checkbox" class="form-control" required v-model="form.ativo"> 
                  </div>
                </div>
              </div>                
              <button style="margin-top: 20px;" type="button" class="btn btn-danger pull-right" @click="onSubmit()">Gravar</button>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-danger">
                  <th>ID</th>
                  <th>Curso</th>
                  <th>Aluno</th>
                  <th>Dt. Admissão</th>
                  <th>Status</th>
                </thead>
                <tbody>
                  <tr  v-for="item in data"
                      :key="item.id">
                    <td>{{ item.id }}</td>
                    <td>{{ item.curso.nome }}</td>
                    <td>{{ item.aluno.nome }}</td>
                    <td>{{ moment(item.data_admissao).format('DD/MM/YYYY') }}</td>
                    <td>{{ item.ativo?'Ativo':'Inativo' }}</td>
                    <td>
                      <button type="button"
                        @click="edit(item)"
                        class="btn btn-danger">
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
    name: 'MatriculasComponent',
    data: function () {
        return {
            data: [],
            form: {
              data_admissao: '',
              aluno: '',
              curso: '',
              ativo: false,
            },
            listAlunos: [],
            listCursos: [],
            selectedAluno: '',
        }
    },
    mounted() {
        this.fetchAll()
    },
    methods: {
      moment,
      fetchAll() {
        this.fetchAlunos()
        this.fetchCursos()
        this.fetchMatriculas()
      },
      fetchAlunos() {
        axios.get('api/alunos')
        .then(response => {
            this.listAlunos = response.data.map (val => ({ label: val.nome, id: val.id }));
        })
      },
      fetchCursos() {
        axios.get('api/cursos')
        .then(response => {
            this.listCursos = response.data.map (val => ({ label: val.nome, id: val.id }));
        })
      },
      fetchMatriculas() {
        axios.get('api/matriculas')
        .then(response => {
            this.data = response.data
        })
      },
      onSubmit() {
        console.log(this.form)
        if (this.form.id) {
          axios.put('api/matriculas/' + this.form.id, this.form)
          .then(response => { this.onSuccess() })
          .catch( error => { this.onError(error) })
          .finally( this.fetchAll())
        }
        else {
          axios.post('api/matriculas', this.form)
          .then(response => { this.onSuccess() })
          .catch( error => { this.onError(error) })
          .finally(this.fetchAll())
        }
        this.form.id = ''
        this.form.data_admissao = ''
        this.form.aluno = ''
        this.form.curso = ''
        this.form.ativo = false
      },
      destroy({ id }) {
        axios.delete('api/matriculas/'+ id)
          .then(response => { this.onSuccess() })
          .catch( error => { this.onError(error) })
          .finally( this.fetchAll())
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
        this.form.aluno = data.aluno_id
        this.form.curso = data.curso_id
        this.form.data_admissao = moment(data.data_admissao).format('YYYY-MM-DD');
      },
    }
  }
</script>