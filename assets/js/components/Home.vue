<template>
	<div>
		<b-navbar toggleable="lg" type="dark" variant="info">
			<b-navbar-brand href="#">
				<img src="./TSS_logo.png" height="50"/>
			</b-navbar-brand>
			<b-navbar-nav class="ml-auto">
				<b-button size="sm" class="my-2 my-sm-0" @click="add">Agregar</b-button>
			</b-navbar-nav>
		</b-navbar><br/>
		<b-container>
			<b-card-group columns>
				<b-card 
					v-for="shoe in shoes"
					:key="shoe.id"
					:title="shoe.brand+' - '+shoe.model" 
					:img-src="shoe.imgUrl" 
					img-alt="Image" 
					img-top style="max-width: 20rem;"
				>
					<b-card-text>
						<h3><b-badge variant="success">${{shoe.price}}</b-badge></h3><br/>
						<b-button 
							variant="primary" 
							@click="edit"
							:data-id="shoe.id"
							:data-brand="shoe.brand"
							:data-model="shoe.model"
							:data-price="shoe.price"
							:data-imgUrl="shoe.imgUrl"
						> Editar </b-button>
						<b-button variant="danger" @click="remove" :data-id="shoe.id">Eliminar</b-button>
					</b-card-text>
				</b-card>
			</b-card-group>
		</b-container>
		<div>
			<b-modal id="new_edit" title="New/Edit Shoe" ref="modal" @ok="handleOkModal">
				<b-form>
					<b-form-group label="Marca:" label-for="brand">
						<b-form-input id="brand" type="text" placeholder="escribe la marca" v-model="brand" />
					</b-form-group>

					<b-form-group label="Modelo:" label-for="model">
						<b-form-input id="model" type="text" placeholder="escribe el modelo" v-model="model" />
					</b-form-group>

					<b-form-group label="Precio:" label-for="price">
						<b-form-input id="price" type="text" placeholder="escribe el precio" v-model="price" />
					</b-form-group>

					<b-form-group label="Imagen:" label-for="imgUrl" description="URL de la imagen">
						<b-form-input id="imgUrl" type="text" placeholder="inserta url de la imagen" v-model="imgUrl" />
					</b-form-group>
				</b-form>
			</b-modal>
		</div>
	</div>
</template>

<script>
import api from '../api';
export default {
	name: "Home",
	data () {
		return {
			modalnew: true,
			id: '',
			brand: '',
			model: '',
			price: '',
			imgUrl: '',
			shoes: []
		}
	},
	methods:{
		add: function (event){
			this.resetModal();
			this.modalnew = true;
			this.$refs.modal.show();
		},
		edit: function (event){
			this.resetModal();
			this.modalnew = false;
			this.id = event.currentTarget.getAttribute('data-id');
			this.brand = event.currentTarget.getAttribute('data-brand');
			this.model = event.currentTarget.getAttribute('data-model');
			this.price = event.currentTarget.getAttribute('data-price');
			this.imgUrl = event.currentTarget.getAttribute('data-imgUrl');

			this.$refs.modal.show();
		},
		remove: function(event) {
			const data = {
				id: event.currentTarget.getAttribute('data-id')
			};
			api.removeShoe(data);
			const self = this
			api.getShoes().then(function (shoes) {self.shoes = shoes })
		},
		handleOkModal: function (event) {
			event.preventDefault()
			if(this.modalnew) {
				this.handleNewSubmit()
			}else{
				this.handleEditSubmit();
			}
		},
		handleNewSubmit: function (event) {
			const data = {
				brand: this.brand,
				model: this.model,
				price: this.price,
				imgUrl: this.imgUrl,
			}

			api.setShoe(data);
			this.$nextTick(() => {this.$refs.modal.hide() })
			const self = this
			api.getShoes().then(function (shoes) {self.shoes = shoes })
		},
		handleEditSubmit: function (event) {
			const data = {
				id: this.id,
				brand: this.brand,
				model: this.model,
				price: this.price,
				imgUrl: this.imgUrl,
			}

			api.editShoe(data);
			this.$nextTick(() => {this.$refs.modal.hide() })
			const self = this
			api.getShoes().then(function (shoes) {self.shoes = shoes })
		},
		resetModal: function () {
			this.id = '';
			this.brand = '';
			this.model = '';
			this.price = '';
			this.imgUrl = '';
		}
	},
	mounted: function () {
		const self = this
		api.getShoes().then(function (shoes) {
			self.shoes = shoes
		})
	}
}
</script>

<style scoped>
</style>