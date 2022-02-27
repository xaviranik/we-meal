import apiFetch from "@wordpress/api-fetch";

const base = 'wemeal';
const version = 'v1';

const Api = {
	get: (endpoint) => {
		return apiFetch({
			path: `/${base}/${version}/${endpoint}`,
			method: 'GET'
		});
	},

	post: (endpoint, data) => {
		return apiFetch({
			path: `/${base}/${version}/${endpoint}`,
			method: 'POST',
			data: data,
		})
	},

	put: (endpoint, data) => {
		return apiFetch({
			path: `/${base}/${version}/${endpoint}`,
			method: 'PUT',
			data: data,
		})
	},

	delete: (endpoint, data) => {
		return apiFetch({
			path: `/${base}/${version}/${endpoint}`,
			method: 'DELETE',
			data: data,
		})
	},
};

export default Api;
