export default HTTP => ({

	async apiUserName(id){
		let { data } = await HTTP
			.get(`user/${id}`)
			.catch((e) => {
					console.log(e)
			});
		return data;
	},
})

