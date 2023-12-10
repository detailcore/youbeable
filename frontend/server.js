const fs = require('fs')
const path = require('path')
const express = require('express')
const server = express()
const renderer = require('vue-server-renderer').createRenderer({
  template: fs.readFileSync('../resources/views/app.blade.php', 'utf-8').replace('<div id="app"></div>', '<!--vue-ssr-outlet-->')
})
const serverBundle = require('../public/js/server-bundle.js')

server.use('./css', express.static(path.resolve(__dirname, '../public/css')))
server.use('./js', express.static(path.resolve(__dirname, '../public/js')))
server.use('./img', express.static(path.resolve(__dirname, '../public/img')))
server.use('/favicon.ico', express.static(path.resolve(__dirname, '../public/favicon.ico')))

server.get('*', (req, res) => {
  let context = { url: req.url, title: 'Not found' }

	serverBundle(context).then(app => {
		renderer.renderToString(app, context, (err, html) => {	
			// console.log(context)
			if(err){
				console.log(err)
			}
	
			res.end(html);
		})
	})
})

const PORT = 3000;
server.listen(PORT, () => {
	console.log(`Example app listening at http://localhost:${PORT}`)
})
