export default HTTP => ({

	async apiSearch(query=''){
		let { data } = await HTTP
			.get('search', { params: { query: query } })
			.catch((e) => {
					console.log(e)
			});
		return data;
	},
})

