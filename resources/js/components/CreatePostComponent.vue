<template>
  <form class="" action="" method="post">
      <div class="row mb-3">
          <label for="title" class="col-md-4 col-form-label text-md-end">Email Address'</label>
          <div class="col-md-6">
              <input id="title" type="text" v-model='item.title'
                class="form-control is-invalid @enderror" name="title" value=" old('email') " required autocomplete="title" autofocus>


                <span class="invalid-feedback" role="alert" v-if="this.errors && this.errors.title">
                    <strong>{{this.errors['title'][0]}}</strong>
                </span>

          </div>
      </div>
      <div class="row mb-3">
          <label for="description" class="col-md-4 col-form-label text-md-end">__('Password')</label>

          <div class="col-md-6">
              <input id="description" v-model='item.description' type="text" class="form-control  is-invalid @enderror" name="description" required autocomplete="description">

              <span class="invalid-feedback" role="alert" v-if="this.errors && this.errors.description">
                  <strong>{{this.errors.description[0]}}</strong>
              </span>
          </div>
      </div>
      <div class="row mb-3">
          <label for="body" class="col-md-4 col-form-label text-md-end">__('Password') </label>

          <div class="col-md-6">
              <input id="body" type="text" v-model='item.body' class="form-control is-invalid @enderror" name="body" required autocomplete="description">

              <span class="invalid-feedback" role="alert" v-if="this.errors && this.errors.body">
                  <strong>{{this.errors['body'][0]}}</strong>
              </span>
          </div>
          <div class="col-md-6">
              <input id="category" type="text" v-model='item.category' class="form-control is-invalid @enderror" name="body" required autocomplete="description">

              <span class="invalid-feedback" role="alert" v-if="this.errors && this.errors.category">
                  <strong>{{this.errors['category'][0]}}</strong>
              </span>
          </div>
      </div>
      <div class="d-flex justify-content-center">
          <input type="button" name="" value="Create" class='btn btn-primary' @click='handleSubmit'>
      </div>
  </form>
</template>

<script>
export default {
    name: 'PostCreateComponent',
    mounted: function() {
        console.log('Component mounted.')
    },
    data: () => {

        return {
            loading: true,
            item: {
                title: '',
                description: '',
                body: ''
            },
            errors: {
            }
        }
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault();
            console.log(this.item);
            var ready = true;
            // for (var variable in this.item) {
            //     if(!this.item[variable]) {
            //       ready =false;
            //     }
            // }

            if(!ready){return;}
            axios.post('/posts/create',{
                title:this.item.title,
                description:this.item.description,
                body:this.item.body
            }).then(res => {
                console.log(res);
            }).catch(err => {
                console.log("DATA:",err.response.data);
                this.errors = err.response.data.errors;
                console.log(this.errors)

            });
        }
    }
}
</script>
<style scoped>

</style>
