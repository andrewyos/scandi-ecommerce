<template>
  <div class="container">
    <div class="header d-flex justify-content-between">
      <h2 class="mainTitle mt-3">Product List</h2>
      <div class="buttonWrapper mt-3">
        <a class="btn btn-primary" href="/addproduct" style="margin-right: 10px">ADD</a>
        <button
          type="button"
          class="btn btn-danger"
          id="delete-product-btn"
          @click="massDelete"
        >
          Mass Delete
        </button>
      </div>
    </div>
    <hr />
    <div class="row" style="height: 75vh">
      <div class="col-3" v-for="item in product" :key="item.id_product">
        <div class="card" style="width: 18rem; height: 35vh">
          <div class="card-body">
            <div class="d-flex">
              <div>
                <input
                  type="checkbox"
                  v-model="selectedProduct"
                  :value="item.id_product"
                />
              </div>
            </div>
            <h5 class="card-title">{{ item.sku }}</h5>
            <p class="card-text">
              {{ item.name }} - {{ item.type.toUpperCase() }}
            </p>
            <p class="card-text">$ {{ item.price }}</p>
            <p class="card-text" v-if="item.type == 'dvd'">
              Size: {{ item.value }}
            </p>
            <p class="card-text" v-else-if="item.type == 'book'">
              Size: {{ item.value }}
            </p>
            <p class="card-text" v-else-if="item.type == 'furniture'">
              Dimension: {{ item.value }}
            </p>
          </div>
        </div>
      </div>
    </div>
    <footer>
      <hr />
      <p class="text-center">Scandiweb Test Assignment</p>
    </footer>
  </div>
</template>

<script>
export default {
  name: "Home",
  data: () => ({
    product: [],
    selectedProduct: [],
  }),
  methods: {
    getDataProduct() {
      this.$axios.get("/read.php").then((response) => {
        this.product = response.data.body;
        // console.log(response.data.body);
        // this.products = response.data;
      });
    },
    massDelete() {
      let paylod = {
        id_product: this.selectedProduct
      }
      this.$axios.post("/deleteMass.php", paylod).then((response) => {
        this.product = [];
        this.getDataProduct();
        console.log(response);
      });
    },
  },
  created() {
    this.getDataProduct();
  },
};
</script>
