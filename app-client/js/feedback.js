/*!
 * ======================================================
 * Upload Images extends FeedBack Template For MUI 
 * =======================================================
 * @version:1.0.0
 * @special thanks:cuihongbao@dcloud.io
 * @creater:kanoyami@92loli.com
 */
function URLencode(sStr) {

	return escape(sStr).replace(/\+/g, '%2B');

}

function Request(url, datas, loding) {
	mui.ajax(url, {
		data: datas,
		dataType: 'json', //服务器返回json格式数据
		type: 'post', //HTTP请求类型
		timeout: 10000, //超时时间设置为5秒；
		beforeSend: function() {
			if(loding) {
				plus.nativeUI.showWaiting("loading");
			}
		},
		complete: function() {
			if(loding) {
				plus.nativeUI.closeWaiting();
			}
		},
		success: function(data) {
			//服务器返回响应，根据响应结果，分析是否登录成功； 
			if(data['status'] == '0') {
				plus.nativeUI.toast(data['info']);
			}
			if(data['status'] == '1') {
				plus.nativeUI.toast("登陆成功");
				console.log(data['img']);
				//console.log(localStorage['username']);
				mui.back();
			} else {
				plus.nativeUI.toast(data['status']);
			}
		},
		error: function(xhr, type, errorThrown) {
			//异常处理；
			console.log(type+" "+errorThrown);
			plus.nativeUI.toast(type+errorThrown);
			return 0;
		}
	});
}

(function() {
	var debug = 0;
	var API = "nuotuan/index.php/Home/PublishUserDynamics/PublishUserDynamics.html";
	if(debug) {
		serverAddress = "http://192.168.1.24:8080/" + API;
	} else {
		serverAddress = "http://115.29.106.55/" + API;
	}
	var index = 1;
	var size = null;
	var imageIndexIdNum = 0;
	var starIndex = 0;
	var feedback = {
		contact: document.getElementById('talk'),
		imageList: document.getElementById('image-list'),
		submitBtn: document.getElementById('submit')
	};
	feedback.files = [];
	feedback.uploader = null;
	feedback.deviceInfo = null;
	mui.plusReady(function() {
		//设备信息，无需修改
	});
	/**
	 *提交成功之后，恢复表单项 
	 */
	feedback.clearForm = function() {
		feedback.question.value = '';
		feedback.contact.value = '';
		feedback.imageList.innerHTML = '';
		feedback.newPlaceholder();
		feedback.files = [];
		index = 0;
		size = 0;
		imageIndexIdNum = 0;
		starIndex = 0;
		//清除所有星标
		mui('.icons i').each(function(index, element) {
			if(element.classList.contains('mui-icon-star-filled')) {
				element.classList.add('mui-icon-star')
				element.classList.remove('mui-icon-star-filled')
			}
		})
	};
	feedback.getFileInputArray = function() {
		return [].slice.call(feedback.imageList.querySelectorAll('.file'));
	};
	feedback.addFile = function(path) {
		feedback.files.push({
			name: "images" + index,
			path: path
		});
		index++;
	};
	/**
	 * 初始化图片域占位
	 */
	feedback.newPlaceholder = function() {
		var fileInputArray = feedback.getFileInputArray();
		if(fileInputArray &&
			fileInputArray.length > 0 &&
			fileInputArray[fileInputArray.length - 1].parentNode.classList.contains('space')) {
			return;
		};
		imageIndexIdNum++;
		var placeholder = document.createElement('div');
		placeholder.setAttribute('class', 'image-item space');
		var up = document.createElement("div");
		up.setAttribute('class', 'image-up')
			//删除图片
		var closeButton = document.createElement('div');
		closeButton.setAttribute('class', 'image-close');
		closeButton.innerHTML = 'X';
		//小X的点击事件
		closeButton.addEventListener('tap', function(event) {
			setTimeout(function() {
				feedback.imageList.removeChild(placeholder);
			}, 0);
			return false;
		}, false);

		//
		var fileInput = document.createElement('div');
		fileInput.setAttribute('class', 'file');
		fileInput.setAttribute('id', 'image-' + imageIndexIdNum);
		fileInput.addEventListener('tap', function(event) {
			var self = this;
			var index = (this.id).substr(-1);

			plus.gallery.pick(function(e) {
				//				console.log("event:"+e);
				var name = e.substr(e.lastIndexOf('/') + 1);
				console.log("name:" + name);

				plus.zip.compressImage({
					src: e,
					dst: '_doc/' + name,
					overwrite: true,
					quality: 50
				}, function(zip) {
					size += zip.size
					console.log("filesize:" + zip.size + ",totalsize:" + size);
					if(size > (10 * 1024 * 1024)) {
						return mui.toast('文件超大,请重新选择~');
					}
					if(!self.parentNode.classList.contains('space')) { //已有图片
						feedback.files.splice(index - 1, 1, {
							name: "images" + index,
							path: e
						});
					} else { //加号
						placeholder.classList.remove('space');
						feedback.addFile(zip.target);
						feedback.newPlaceholder();
					}
					up.classList.remove('image-up');
					placeholder.style.backgroundImage = 'url(' + zip.target + ')';
				}, function(zipe) {
					mui.toast('压缩失败！')
				});

			}, function(e) {
				mui.toast(e.message);
			}, {});
		}, false);
		placeholder.appendChild(closeButton);
		placeholder.appendChild(up);
		placeholder.appendChild(fileInput);
		feedback.imageList.appendChild(placeholder);
	};
	feedback.newPlaceholder();
	feedback.submitBtn.addEventListener('tap', function() {
		datas = {
			content: feedback.contact.value,
			token: URLencode(localStorage.token),
			uid: localStorage.uid,
			
		};
		console.log(datas['token'] + datas['uid'])
		Request(serverAddress, datas, true);
	});
})();