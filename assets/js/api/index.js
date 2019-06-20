const api = {
	getShoes() {
		return fetch('/api/shoes').then(function(response) {
		    return response.json();
		});
	},
	setShoe(data) {
		return fetch('/api/shoe/new',{
			method: 'POST',
			body: JSON.stringify(data),
			headers:{
			'Content-Type': 'application/json'
		}}).then(function(response) {
		    return response;
		});
	},
	editShoe(data) {
		return fetch('/api/shoe/edit',{
			method: 'POST',
			body: JSON.stringify(data),
			headers:{
			'Content-Type': 'application/json'
		}}).then(function(response) {
		    return response;
		});
	},
	removeShoe(data) {
		return fetch('/api/shoe/remove',{
			method: 'POST',
			body: JSON.stringify(data),
			headers:{
			'Content-Type': 'application/json'
		}}).then(function(response) {
		    return response;
		});
	},
	getUsers() {
		return fetch('/api/users').then(function(response) {
		    return response.json();
		});
	},
	setUser() {
		return fetch('/api/user/new', {
			method: 'POST',
			body: JSON.stringify(data),
			headers:{
			'Content-Type': 'application/json'
		}}).then(function(response) {
		    return response;
		});
	},
}

export default api;