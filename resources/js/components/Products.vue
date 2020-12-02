<template>
	<div class="row" style="padding: 0px 15px;">
		<div class="col-md-6">

			<div class="row">
				<div class="col-md-10"><h2 style="padding: ">Products</h2></div>
				<div class="col-md-2">
					<button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#addModal" @click="clearForm()">Add</button>
				</div>
			</div>
			

				<div class="card card-body" v-for="product in products" v-bind:key="product.id">
					<h4>{{product.title}}</h4>

					<p> {{product.description}} </p>
					<div> <span class="pull-left"> {{product.price}} </span>                 <span class="pull-right"> {{product.quantity}} </span> </div>
					<hr>
					<div class="row">
						<div class="col-md-8"></div>
						<div class="col-md-4">
							<button class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#addModal" @click="editProduct(product)">Edit</button>
							<button class="btn btn-danger btn-sm pull-right" @click="deleteProduct(product.id)">Delete</button>
						</div>
					</div>			
					
				</div>

				<nav aria-label="Page navigation example">
					<ul class="pagination pagination-sm">
					  <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchProducts(pagination.prev_page_url)">Previous</a></li>
					  <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
					  <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchProducts(pagination.next_page_url)">Next</a></li>
					</ul>
				</nav>



		</div>

	

		<!-- The Modal -->
		<form @submit.prevent="addProduct">
		  <div class="modal fade" id="addModal">
		    <div class="modal-dialog">
		      <div class="modal-content">
		      
		        <!-- Modal Header -->
		        <div class="modal-header">
		          <h4 class="modal-title">Add and Edit Product</h4>
		          <button type="button" class="close" data-dismiss="modal">×</button>
		        </div>
		        
		        <!-- Modal body -->
		        <div class="modal-body">
		           <div class="form-group row">
		                <div class="col-sm-12">
						<label for="title" class="col-sm-12 col-form-label"> Title </label>
		                    <input type="text" class="form-control" placeholder="title" v-model="product.title">
		                </div>
					</div>

					<div class="form-group row">
		                <div class="col-sm-12">
						<label for="description" class="col-sm-12 col-form-label"> Description </label>
		                    <textarea rows="2" class="form-control" placeholder="description" v-model="product.description"></textarea>
		                </div>
					</div>
		           <div class="form-group row">
		                <div class="col-sm-12">
						<label for="price" class="col-sm-12 col-form-label"> Price </label>
		                    <input type="text" class="form-control" placeholder="price" v-model="product.price">
		                </div>
					</div>
		           <div class="form-group row">
		                <div class="col-sm-12">
						<label for="quantity" class="col-sm-12 col-form-label"> Quantity </label>
		                    <input type="text" class="form-control" placeholder="quantity" v-model="product.quantity">
		                </div>
					</div>

		        </div>
		        
		        <!-- Modal footer -->
		        <div class="modal-footer">
		          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
		            <button type="submit" class="btn btn-success btn-sm">Save</button>
		        </div>
		        
		      </div>
		    </div>
		  </div>
		</form>
	</div>
</template>





<script>
	export default
	{
		data(){
			return{
				products: [],
				product: {
					id: '',
					title: '',
					description: '',
					price: '',
					quantity: ''
				},
				product_id: '',
				pagination: {},
				edit: false
			}
		},

		created()
		{
			this.fetchProducts();
		},

		methods: 
		{
			fetchProducts(page_url)
			{
			let vm = this;
			page_url = page_url || '/api/products'
				fetch(page_url)
				.then(res => res.json())
				.then(res => {
					this.products = res.data;
					vm.makePagination(res.meta, res.links);
				})
				.catch(err => console.log(err));
			},
			makePagination(meta, links)	{
				let pagination = {
					current_page: meta.current_page,
					last_page: meta.last_page,
					next_page_url: links.next,
					prev_page_url: links.prev
				};

				this.pagination = pagination;
			},

			deleteProduct(id)
			{
				if(confirm('Are You Sure You Want To Delete Record?'))
				{
					fetch(`api/product/${id}`, {
						method: 'delete'
					})
					.then(res => res.json())
					.then(data => {
						alert('Product Deleted');
						this.fetchProducts();
					})
					.catch(err => console.log(err));
				}
			},

			addProduct(){
				if(this.edit === false)
				{
					fetch('api/product', 
					{
						method: 'post',
						body: JSON.stringify(this.product),
						headers: {
							'content-type': 'application/json'
						}
					})
					.then(res => res.json())
					.then(data => {
						this.product.title = '';
						this.product.description = '';
						this.product.price = '';
						this.product.quantity = '';
						alert('Product Has Been Added Successfully');
						this.fetchProducts();
					})
					.catch(err => console.log(err)); 
					$('#addModal').trigger('click');

				}
				else
				{
					fetch('api/product', 
					{
						method: 'put',
						body: JSON.stringify(this.product),
						headers: {
							'content-type': 'application/json'
						}
					})
					.then(res => res.json())
					.then(data => {
						this.product.title = '';
						this.product.description = '';
						this.product.price = '';
						this.product.quantity = '';
						alert('Product Has Been Updated');
						this.fetchProducts();
					}) 
					.catch(err => console.log(err));
					$('#addModal').trigger('click');
				}
				},

				editProduct(product)
				{
					this.edit = true;
					this.product.id = product.id;
					this.product.product_id = product.id;
					this.product.title = product.title;
					this.product.description = product.description;
					this.product.price = product.price;
					this.product.quantity = product.quantity;
				},



				clearForm()
				{
					this.product.title = '';
					this.product.description = '';
					this.product.price = '';
					this.product.quantity = '';
				}
		}
	};
</script>