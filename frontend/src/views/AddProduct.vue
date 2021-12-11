<template>
  <div class="container">
    <div class="header d-flex justify-content-between">
      <h2 class="mainTitle mt-3">Product Add</h2>
      <div class="buttonWrapper mt-3">
        <button type="button" class="btn btn-success" style="margin-right: 10px" @click="save">
          Save
        </button>
        <button type="button" class="btn btn-danger" @click="cancel">
          Cancel
        </button>
      </div>
    </div>
    <hr />
    <div class="body" style="height: 75vh">
      <form id="product_form">
        <div class="row">
          <div class="col-6">
            <div class="d-flex flex-column">
              <div class="d-flex justify-content-between">
                <label for="sku" class="form-label">SKU</label>
                <input
                  type="text"
                  class="form-control"
                  id="sku"
                  style="width: 25rem"
                  v-model="form.sku"
                  disabled
                />
              </div>
              <div class="d-flex justify-content-between mt-3">
                <label for="name" class="form-label">Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  style="width: 25rem"
                  v-model="form.name"
                />
              </div>
              <div class="d-flex justify-content-between mt-3">
                <label for="price" class="form-label">Price ($)</label>
                <input
                  type="text"
                  class="form-control"
                  id="price"
                  style="width: 25rem"
                  v-model="form.price"
                />
              </div>
              <div class="d-flex justify-content-between mt-3">
                <label for="type" class="form-label">Type Switcher</label>
                <select
                  class="form-select"
                  aria-label="Default select example"
                  id="type"
                  style="width: 25rem"
                  v-model="typeSwitcher"
                >
                  <option value="DVD">DVD</option>
                  <option value="BOOK">BOOK</option>
                  <option value="FURNITURE">FURNITURE</option>
                </select>
              </div>
              <div
                class="d-flex justify-content-between mt-3"
                v-if="typeSwitcher == 'DVD'"
              >
                <label for="price" class="form-label">Size (MB)</label>
                <input
                  type="text"
                  class="form-control"
                  id="price"
                  style="width: 25rem"
                  v-model="value.dvd.size"
                />
              </div>
              <div
                class="d-flex justify-content-between mt-3"
                v-else-if="typeSwitcher == 'BOOK'"
              >
                <label for="price" class="form-label">Weight (KG)</label>
                <input
                  type="text"
                  class="form-control"
                  id="price"
                  style="width: 25rem"
                  v-model="value.book.weight"
                />
              </div>
              <div v-else-if="typeSwitcher == 'FURNITURE'">
                <div class="d-flex justify-content-between mt-3">
                  <label for="price" class="form-label">Height (CM)</label>
                  <input
                    type="text"
                    class="form-control"
                    id="price"
                    style="width: 25rem"
                    v-model="value.furniture.height"
                  />
                </div>
                <div class="d-flex justify-content-between mt-3">
                  <label for="price" class="form-label">Width (CM)</label>
                  <input
                    type="text"
                    class="form-control"
                    id="price"
                    style="width: 25rem"
                    v-model="value.furniture.width"
                  />
                </div>
                <div class="d-flex justify-content-between mt-3">
                  <label for="price" class="form-label">Length (CM)</label>
                  <input
                    type="text"
                    class="form-control"
                    id="price"
                    style="width: 25rem"
                    v-model="value.furniture.length"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="col-6"></div>
        </div>
      </form>
    </div>
    <footer>
      <hr />
      <p class="text-center">Scandiweb Test Assignment</p>
    </footer>
  </div>
</template>

<script>
export default {
  data: () => ({
    typeSwitcher: null,
    form: {
      sku: null,
      name: null,
      price: null,
      type: null,
    },
    value: {
      dvd: {
        size: null,
      },
      book: {
        weight: null,
      },
      furniture: {
        height: null,
        width: null,
        length: null,
      },
    },
  }),
  methods: {
    save() {
      let payload = {
        ...this.form,
      };
      payload.type = this.typeSwitcher;
      if (this.typeSwitcher == "DVD") {
        payload.value = this.value.dvd.size + " MB";
      } else if (this.typeSwitcher == "BOOK") {
        payload.value = this.value.book.weight + " KG";
      } else if (this.typeSwitcher == "FURNITURE") {
        payload.value =
          this.value.furniture.height +
          " CM x " +
          this.value.furniture.width +
          " CM x " +
          this.value.furniture.length +
          " CM";
      }
      this.$axios.post("/create.php", payload).then((response) => {
        this.resetAllForm();
        console.log(response);
      });
    },
    getSkuRandom() {
      this.form.sku =
        "PR" +
        Math.floor(Math.random() * 1000000).toString() +
        Math.round(new Date().getTime() / 1000).toString();
    },
    cancel() {
      this.$router.push("/");
    },
    resetAllForm() {
      this.form = {
        sku: null,
        name: null,
        price: null,
        type: null,
      };
      this.value = {
        dvd: {
          size: null,
        },
        book: {
          weight: null,
        },
        furniture: {
          height: null,
          width: null,
          length: null,
        },
      };
      this.getSkuRandom();
    },
  },
  created() {
    this.getSkuRandom();
  },
};
</script>

<style>
</style>