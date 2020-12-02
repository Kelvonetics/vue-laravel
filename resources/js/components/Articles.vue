<template>
	<div class="row" style="padding: 0px 15px;">
		<div class="col-md-6">

			<div class="row">
				<div class="col-md-10"><h2 style="padding: ">Articles</h2></div>
				<div class="col-md-2">
					<button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#addModal" @click="clearForm()">Add</button>
				</div>
			</div>
			



				<div class="card card-body" v-for="article in articles" v-bind:key="article.id">
					<h4>{{article.title}}</h4>

					<p> {{article.body}} </p>
					<hr>
					<div class="row">
						<div class="col-md-8"></div>
						<div class="col-md-4">
							<button class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#addModal" @click="editArticle(article)">Edit</button>
							<button class="btn btn-danger btn-sm pull-right" @click="deleteArticle(article.id)">Delete</button>
						</div>
					</div>			
					
				</div>

				<nav aria-label="Page navigation example">
					<ul class="pagination pagination-sm">
					  <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchArticles(pagination.prev_page_url)">Previous</a></li>
					  <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
					  <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchArticles(pagination.next_page_url)">Next</a></li>
					</ul>
				</nav>
		</div>

	

		<!-- The Modal -->
		<form @submit.prevent="addArticle">
		  <div class="modal fade" id="addModal">
		    <div class="modal-dialog">
		      <div class="modal-content">
		      
		        <!-- Modal Header -->
		        <div class="modal-header">
		          <h4 class="modal-title">Add and Edit Article</h4>
		          <button type="button" class="close" data-dismiss="modal">×</button>
		        </div>
		        
		        <!-- Modal body -->
		        <div class="modal-body">
		           <div class="form-group row">
		                <div class="col-sm-12">
						<label for="title" class="col-sm-12 col-form-label"> Title </label>
		                    <input type="text" class="form-control" placeholder="title" v-model="article.title">
		                </div>
					</div>

					<div class="form-group row">
		                <div class="col-sm-12">
						<label for="body" class="col-sm-12 col-form-label"> Body </label>
		                    <textarea rows="2" class="form-control" placeholder="body" v-model="article.body"></textarea>
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
				articles: [],
				article: {
					id: '',
					title: '',
					body: ''
				},
				article_id: '',
				pagination: {},
				edit: false
			}
		},

		created()
		{
			this.fetchArticles();
		},

		methods: 
		{
			fetchArticles(page_url)
			{
			let vm = this;
			page_url = page_url || '/api/articles'
				fetch(page_url)
				.then(res => res.json())
				.then(res => {
					this.articles = res.data;
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

			deleteArticle(id)
			{
				if(confirm('Are You Sure You Want To Delete Record?'))
				{
					fetch(`api/article/${id}`, {
						method: 'delete'
					})
					.then(res => res.json())
					.then(data => {
						alert('Article Deleted');
						this.fetchArticles();
					})
					.catch(err => console.log(err));
				}
			},

			addArticle(){
				if(this.edit === false)
				{
					fetch('api/article', 
					{
						method: 'post',
						body: JSON.stringify(this.article),
						headers: {
							'content-type': 'application/json'
						}
					})
					.then(res => res.json())
					.then(data => {
						this.article.title = '';
						this.article.body = '';
						alert('Article Has Been Added');
						this.fetchArticles();
					})
					.catch(err => console.log(err));
				}
				else
				{
					fetch('api/article', 
					{
						method: 'put',
						body: JSON.stringify(this.article),
						headers: {
							'content-type': 'application/json'
						}
					})
					.then(res => res.json())
					.then(data => {
						this.article.title = '';
						this.article.body = '';
						alert('Article Has Been Updated');
						this.fetchArticles();
					})
					.catch(err => console.log(err));
				}
				},

				editArticle(article)
				{
					this.edit = true;
					this.article.id = article.id;
					this.article.article_id = article.id;
					this.article.title = article.title;
					this.article.body = article.body;
				},



				clearForm(){
					this.article.title = '';
					this.article.body = '';
				}
		}
	};
</script>