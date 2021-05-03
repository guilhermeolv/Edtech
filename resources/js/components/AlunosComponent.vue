<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Cadastro de alunos</h4>
            <p class="card-category">Informe as informações nos campos abaixo</p>
          </div>
          <div class="card-body">
            <form>
              <div class="row" style="margin-top: 10px;">
                <div class="col-md-5">
                  <div class="form-group">
                    <label class="bmd-label-floating">Nome</label>
                    <input  type="text" 
                      class="form-control" 
                      required
                      v-model="form.nome"
                      name="nome"
                      id="nome">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">E-mail</label>
                    <input  type="email" 
                      class="form-control" 
                      required
                      v-model="form.email"
                      name="email"
                      id="email">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="bmd-label-floating">Senha</label>
                    <input  type="password" 
                      class="form-control" 
                      required
                      v-model="form.senha"
                      name="senha"
                      id="senha">
                  </div>
                </div>
              </div>
              <button style="margin-top: 20px;" 
                type="button" 
                class="btn btn-primary pull-right"
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
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Alunos cadastrados</h4>
            <p class="card-category">Clique para editar</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    ID
                  </th>
                  <th>
                    Nome
                  </th>
                  <th>
                    Email
                  </th>
                  <th>
                    Senha
                  </th>
                </thead>
                <tbody>
                  <tr v-for="aluno in alunos"
                    :key="aluno.id">
                    <td>
                      {{ aluno.id }}
                    </td>
                    <td>
                      {{ aluno.nome }}
                    </td>
                    <td>
                      {{ aluno.email }}
                    </td>
                    <td>
                      {{ aluno.senha }}
                    </td>
                    <td>
                      <button type="button"
                        @click="editAluno(aluno)"
                        class="btn btn-primary">
                      <i class="material-icons">edit</i>
                      </button>
                      <button type="button"
                        @click="deleteAluno(aluno)"
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
      name: 'AlunosComponent',
      data: function () {
          return {
              alunos: [],
              form: {
                id: '',
                nome: '',
                email: '',
                senha: '',
              },
          }
      },
      mounted() {
          this.fetchRecords()
      },
      methods: {
          fetchRecords() {
              axios.get('api/alunos')
              .then(response => {
                  this.alunos = response.data
              })
          },
          onSubmit() {
            
            if (this.form.id) {
              axios.put('api/alunos/' + this.form.id, this.form)
              .then(response => { this.onSuccess() })
              .catch( error => { this.onError(error) })
              .finally( this.fetchRecords() )
            }
            else {
              axios.post('api/alunos', this.form)
              .then(response => { this.onSuccess() })
              .catch( error => { this.onError(error) })
              .finally( this.fetchRecords() )
            }
            this.form.id = ''
            this.form.nome = ''
            this.form.email = ''
            this.form.senha = ''
          },
          deleteAluno({ id }) {
            axios.delete('api/alunos/'+ id)
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
          editAluno(aluno) {
            this.form = aluno
          },
      },
  }
</script>