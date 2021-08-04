<template>
  <div class="container">
    <!-- <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
         
                   
                </div>



            </div>
        </div> -->
    <div>
      <b-table striped hover :items="items">
      </b-table>
      <div>
        TOTAL DINERS: {{ diners }} <br>
        TOTAL: {{ total_retotal }}
      </div>
    </div>
    <div>
      <b-button v-b-modal.modal-1>Compra/Venta</b-button>
      <b-button @click="agafa_valors">Actualitza valors de preus</b-button>

      <b-modal id="modal-1" title="Operació de compra/venta">
        <div>
          <b-form @submit="onSubmit">
            <b-form-group
              id="input-group-1"
              label="Producte:"
              label-for="input-1"
              description="Escollix el producte en el que vols operar."
            >
              <b-form-select
                id="input-1"
                v-model="form.producte"
                :options="['Roig', 'Taronja', 'Groc', 'Verd','Blau', 'Indigo','Violeta']"
                required
              ></b-form-select>
            </b-form-group>

            <b-form-group
              id="input-group-2"
              label="Quantitat:"
              label-for="input-2"
            >
              <b-form-input
                id="input-2"
                v-model="form.quantitat"
                placeholder="Quantitat"
                type="number"
                required
              ></b-form-input>
            </b-form-group>

            <b-form-group
              id="input-group-3"
              label="Operacio:"
              label-for="input-3"
            >
              <b-form-select
                id="input-3"
                v-model="form.operacio"
                :options="['Compra', 'Venta']"
                required
              ></b-form-select>
            </b-form-group>

            <b-button type="submit" variant="primary">Opera</b-button>
          </b-form>
        </div>
      </b-modal>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      items: [
        { producte: "Roig", quantitat: 0, valor: 0 },
        { producte: "Taronja", quantitat: 0, valor: 0 },
        { producte: "Groc", quantitat: 0, valor: 0 },
        { producte: "Verd", quantitat: 0, valor: 0 },
        { producte: "Blau", quantitat: 0, valor: 0 },
        { producte: "Indigo", quantitat: 0, valor: 0 },
        { producte: "Violeta", quantitat: 0, valor: 0 },
      ],
      colors: [
        { color: "Roig", index: 0, valor: 0 },
        { color: "Taronja", index: 1, valor: 0 },
        { color: "Groc", index: 2, valor: 0 },
        { color: "Verd", index: 3, valor: 0 },
        { color: "Blau", index: 4, valor: 0 },
        { color: "Indigo", index: 5, valor: 0 },
        { color: "Violeta", index: 6, valor: 0 },
      ],
      form: {
        producte: "",
        quantitat: "",
        operacio: null,
      },
      show: true,
      diners: 0,
      total_valors: 0
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    onSubmit(event) {
      event.preventDefault();
      //alert(JSON.stringify(this.form));
      let url = this.form.producte;
      let params = this.form;
      axios
        .post(url, params)
        .then((res) => {
          console.log(res);
          this.$toast.success(res.data.message);
          this.colors.forEach(element => {
            if (element.color == this.form.producte){
              this.items[element.index].quantitat=res.data.quantitat;
            }
          });
          this.diners = res.data.diners; 
        })
        .catch((err) => {
          console.error(err);
          this.$toast.error(err.response.data.message);
        });
        this.calcula_total();    

    },
    agafa_valors () {
      let url = 'Valors';
      axios.get(url)
      .then(res => {
        console.log(res)
        for (let index = 0; index < this.items.length; index++) {
          this.items[index].valor = res.data[index]['valor'];      
        }
      })
      .catch(err => {
        console.error(err); 
      })
    },
    agafa_diners () {
      let url = 'Diners';
      axios.get(url)
      .then(res => {
        console.log(res)
        this.diners=res.data;
      })
      .catch(err => {
        console.error(err); 
      })
    },
    agafa_productes(url,index){
      axios.get(url)
      .then(res => {
        console.log(res);
        if (typeof res.data[0] === 'undefined') {
          this.items[index].quantitat = 0;
        } else {
          this.items[index].quantitat = res.data[0]['quantitat'];
        }
              
      })
      .catch(err => {
        console.error(err); 
      })
    },
    calcula_total(){
      this.total_valors = 0;
      for (let index = 0; index < this.items.length; index++) {
        this.total_valors += this.items[index].quantitat*this.items[index].valor;
      }
      this.total_valors += this.diners;
    }
  },
  beforeMount() {
    this.agafa_valors();
    this.agafa_diners();
    this.colors.forEach(element => {
      this.agafa_productes(element.color,element.index);
    });
    
    
  },
  computed: {
    total_retotal() {
      let total_valors = 0;
      for (let index = 0; index < this.items.length; index++) {
        total_valors += this.items[index].quantitat*this.items[index].valor;
      }
      total_valors += this.diners;
      return total_valors;
    }
  }
};
</script>
