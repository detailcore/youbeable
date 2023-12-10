import axios from 'axios';


export default () => {
	let baseURL = '/api/'

	if(process.isServer) {
		baseURL = 'http://127.0.0.1:8000' + baseURL
	}
	
	const HTTP = axios.create({
	  baseURL,
	  timeout: 15000,
	  withCredentials: true
	})

	return HTTP
}
