
			debug = 0;
			if(debug) {
				serverAddress = "http://192.168.1.105:8080/nuotuan/index.php";
			} else {
				serverAddress = "http://115.29.106.55/nuotuan/index.php";
			}

			mui.init({
				gestureConfig: {
					doubletap: true
				}
			});
			//-------------相关全局变量--------------------------------
			var IS_LOGIN = false;
			var SUB_PAGES = 'pullrefresh_main.html';
			var SUB_PAGES_MYHOME = 'myhome_pullrefresh_main.html';
			var SUB_PAGES_SETTING = 'setting.html';
			var SUBPAGES_STYLE = {
				top: '44px',
				bottom: '51px'
			};
			var ANI_SHOW = {};
			var LOGIN_NAME = null;
			var TOKEN = null;
			var UID = null;
			var SUB_ACTIVE = false;
			var SUB_MYHOME_ACTIVE = false;
			var SUB_SETTING_ACTIVE = false;
			mui.ready(function() {

				document.getElementById("container").style.height = document.documentElement.clientHeight - 49 + 'px';
				if(debug) console.log("1");

			});

			mui.plusReady(function() {
				if(localStorage.token != '' && localStorage.uid != '' && localStorage.username != '' &&
					typeof(localStorage.token) != "undefined" && typeof(localStorage.uid) != "undefined" && typeof(localStorage.username) != "undefined") {
					IS_LOGIN = true;
					LOGIN_NAME = localStorage.username;
					UID = localStorage.uid;
					TOKEN = localStorage.token;
					if(debug) console.log(localStorage['username']);
					loginDo();
				}

				window.addEventListener('loginSuccess', function(event) {
					IS_LOGIN = true;
					if(event.detail.rememberLogin) {
						localStorage.username = event.detail.username;
						localStorage.token = event.detail.token;
						localStorage.uid = event.detail.uid;
						LOGIN_NAME = localStorage.username;
						UID = localStorage.uid;
						TOKEN = localStorage.token;
						console.log(localStorage.uid);
					} else localStorage.username = '';
					//document.write(localStorage.username);
					LOGIN_NAME = event.detail.username;
					TOKEN = event.detail.token;
					loginDo();
				});
				window.addEventListener('dologout', function(event) {
					//document.getElementById('logout').click();
					mui.trigger(document.getElementById('logout'), 'tap');
					console.log("logout");
				});

				function loginDo() {
					document.getElementById('login_a').style.display = "none";
					document.getElementById('login_b').style.display = "none";
					var offcanvas = document.getElementById('offCanvasUl');
					var childs = document.getElementsByClassName('mui-table-view-cell');
					for(var i = 0; i < childs.length; i++) {
						childs[i].style.display = "none";
					}
					document.getElementById('user_name').innerHTML = LOGIN_NAME;
					var li = document.createElement('li');
					li.className = "mui-table-view-cell";
					li.id = "myHomeLi";
					li.innerHTML = '<a class="mui-navigate-right" open-type="common" href=""><span class="mui-icon-person mui-icon"></span> 个人中心</a>';
					offcanvas.appendChild(li);
					var li = document.createElement('li');
					li.className = "mui-table-view-cell";
					li.id = "settingLi";
					li.innerHTML = '<a class="mui-navigate-right" open-type="common" href=""><span class="mui-icon-gear mui-icon"></span> 设置</a>';
					offcanvas.appendChild(li);
					var li = document.createElement('li');
					li.className = "mui-table-view-cell";
					li.id = "clearCacheLi";
					li.innerHTML = '<a class="mui-navigate-right" open-type="common" href=""><span class="mui-icon-trash mui-icon"></span> 清除缓存</a>';
					offcanvas.appendChild(li);
					document.getElementById('clearCacheLi').addEventListener('tap', function(e) {
						//------clear cache do
						plus.nativeUI.toast('清除缓存成功');
					});
					document.getElementById('logout').style.display = "";
					document.getElementById('logout').addEventListener('tap', function(event) {
						var all = plus.webview.all();
						var current = plus.webview.currentWebview().id;
						for(var i = 0, len = all.length; i < len; i++) {
							if(all[i].id !== current) {
								all[i].close();
							}
						}
						offcanvas.removeChild(document.getElementById('settingLi'));
						offcanvas.removeChild(document.getElementById('myHomeLi'));
						offcanvas.removeChild(document.getElementById('clearCacheLi'));
						document.getElementById('user_name').innerHTML = "未登录";
						document.getElementById('logout').style.display = "none";
						for(var i = 0; i < childs.length; i++) {
							childs[i].style.display = "";
						}
						localStorage['username'] = '';
						localStorage['uid'] = '';
						localStorage['token'] = '';
						SUB_ACTIVE = false;
						SUB_MYHOME_ACTIVE = false;
						IS_LOGIN = false;

					});
				}

				var wrap = document.getElementById("main-wrap");
				wrap.addEventListener('drag', function stopDarg(event) {
					event.stopPropagation();
				});
				var index = document.getElementById("index");
				var home = document.getElementById("myHome");
				var clubActive = document.getElementById("clubActive");
				var setting = document.getElementById("setting");
				home.style.display = "none";
				clubActive.style.display = "none";
				setting.style.display = "none";
				var menuReg = document.getElementById("menuReg");
				var menuLog = document.getElementById("menuLog");
				var homeBtn = document.getElementById("homeBtn");
				var indexBtn = document.getElementById("indexBtn");
				var clubActiveBtn = document.getElementById("clubActiveBtn");
				var settingBtn = document.getElementById("settingBtn");
				var plus_bar = document.getElementById('title-icon-plus');

				plus_bar.addEventListener('tap', function(e) {
					mui.openWindow('view/addUserDy.html');
				});

				function changeActiveTab(tab, ifShowTabIcon, title) {
					if(ifShowTabIcon) {
						document.getElementById("title-icon").style.display = "";
						document.getElementById("title-icon-plus").style.display = "none";
					} else {
						document.getElementById("title-icon").style.display = "none";
						document.getElementById("title-icon-plus").style.display = "";
					}
					if(tab.id == index.id) {
						tab.style.display = "";
						clubActive.style.display = "none";
						setting.style.display = "none";
						home.style.display = "none";
					}
					if(tab.id == home.id) {
						tab.style.display = "";
						clubActive.style.display = "none";
						setting.style.display = "none";
						index.style.display = "none";
					}
					if(tab.id == clubActive.id) {
						tab.style.display = "";
						home.style.display = "none";
						setting.style.display = "none";
						index.style.display = "none";
					}
					if(tab.id == setting.id) {
						tab.style.display = "";
						clubActive.style.display = "none";
						home.style.display = "none";
						index.style.display = "none";
					}

					//plus.webview.close('pullrefresh_main.html');
					document.getElementById("title").innerHTML = title;
				}

				indexBtn.addEventListener('tap', function(event) {
					changeActiveTab(index, true, "附近的社团");
					plus.webview.hide(SUB_PAGES);
					plus.webview.hide(SUB_PAGES_MYHOME);
					plus.webview.hide(SUB_PAGES_SETTING);

				});

				clubActiveBtn.addEventListener('tap', function(event) {
					//mui.openWindow("pullrefresh_main.html", "test");
					plus.webview.hide(SUB_PAGES_MYHOME);
					plus.webview.hide(SUB_PAGES_SETTING);
					//changeActiveTab(clubActive, false, "社团动态");
					if(IS_LOGIN) {
						if(SUB_ACTIVE) {
							plus.webview.show(SUB_PAGES);
						} else {
							//var self = plus.webview.currentWebview();
							console.log(UID + TOKEN);
							var sub = mui.openWindow(SUB_PAGES, SUB_PAGES, {
								styles: {
									top: '0px',
									bottom: '51px'
								},
								show: ANI_SHOW,
								extras: {
									uid: UID,
									username: LOGIN_NAME,
									token: TOKEN
								}
							});
							//var sub = plus.webview.create(SUB_PAGES, SUB_PAGES, SUBPAGES_STYLE);
							//self.append(sub);

							SUB_ACTIVE = true;
						}
					} else {
						document.getElementById('login_a').style.display = "";

					}

				});

				homeBtn.addEventListener('tap', function(event) {
					//plus.webview.close('pullrefresh_main.html');

					plus.webview.hide(SUB_PAGES);
					plus.webview.hide(SUB_PAGES_SETTING);
					changeActiveTab(home, false, "我的动态");
					if(IS_LOGIN) {
						if(SUB_MYHOME_ACTIVE) {
							plus.webview.show(SUB_PAGES_MYHOME);
						} else {
							//var self = plus.webview.currentWebview();
							console.log(UID + TOKEN);
							var sub = mui.openWindow(SUB_PAGES_MYHOME, SUB_PAGES_MYHOME, {
								styles: SUBPAGES_STYLE,
								show: ANI_SHOW,
								extras: {
									uid: UID,
									username: LOGIN_NAME,
									token: TOKEN
								}
							});
							//var sub = plus.webview.create(SUB_PAGES, SUB_PAGES, SUBPAGES_STYLE);
							//self.append(sub);

							SUB_MYHOME_ACTIVE = true;
						}
					} else {
						document.getElementById('login_b').style.display = "";
					}

				});

				settingBtn.addEventListener('tap', function(event) {
					//plus.webview.close('pullrefresh_main.html');
					plus.webview.hide(SUB_PAGES);
					plus.webview.hide(SUB_PAGES_MYHOME);
					changeActiveTab(setting, false, "设置");
					if(SUB_SETTING_ACTIVE) {
						plus.webview.show(SUB_PAGES_SETTING);
					} else {
						//var self = plus.webview.currentWebview();
						console.log(UID + TOKEN);
						var sub = mui.openWindow(SUB_PAGES_SETTING, SUB_PAGES_SETTING, {
							styles: {
								top: '0px',
								bottom: '51px'
							},
							show: ANI_SHOW,
							extras: {
								uid: UID,
								username: LOGIN_NAME,
								token: TOKEN
							}
						});
						//var sub = plus.webview.create(SUB_PAGES, SUB_PAGES, SUBPAGES_STYLE);
						//self.append(sub);

						SUB_SETTING_ACTIVE = true;
					}

				});
				menuReg.addEventListener('tap', function(event) {
					mui.openWindow({
						url: "view/reg.html",
						id: "reg"
					});
				});

				menuLog.addEventListener('tap', function(event) {
					mui.openWindow({
						url: "view/login.html",
						id: "login"
					});
				});

				//plus.webview.close('pullrefresh_main.html');
				map = new BMap.Map("container");
				//console.log(navigator.geolocation);// 创建地图实例
				var geolocation = new BMap.Geolocation();
				geolocation.getCurrentPosition(function(r) {
					if(this.getStatus() == BMAP_STATUS_SUCCESS) {
						var imk = new BMap.Marker(r.point);
						map.addOverlay(imk);
						map.centerAndZoom(r.point, 16);
						//map.panTo(r.point);
						var label = new BMap.Label("您的位置", {
							offset: new BMap.Size(-5, -15)
						});
						imk.setLabel(label);
						if(debug) console.log('您的位置：' + r.point.lng + ',' + r.point.lat);

						mui.getJSON(serverAddress, {
							lng: r.point.lng,
							lat: r.point.lat
						}, function(data) {

							for(var i = 0; i < data['length']; i++) {
								if(debug) console.log(data['datas'][i]['lng'] + "," + data['datas'][i]['lat']);
								var flag = new BMap.Point(data['datas'][i]['lng'], data['datas'][i]['lat']);
								var mk = new BMap.Marker(flag);
								mk.addEventListener('click', function(event) {
									console.log('1');
								});
								map.addOverlay(mk);
								var label = new BMap.Label(data['datas'][i]['groupName'], {
									offset: new BMap.Size(-5, -15)
								});
								mk.setLabel(label);
							}
						}, 'json');

					} else {
						alert('failed' + this.getStatus());
					}
				});

				//puls+定位 莫名失败。。。。
				/*plus.geolocation.getCurrentPosition(function(p) {
					var currentLon = p.coords.longitude;
					var currentLat = p.coords.latitude;
					console.log(currentLat + currentLon);
					var gpsPoint = new BMap.Point(currentLon, currentLat);
					map.centerAndZoom(gpsPoint, 16);
					map.addOverlay(new BMap.Marker(gpsPoint));
					//BMap.Convertor.translate(gpsPoint, 15, function() {});
				}, function(error) {
					console.log(error);
					switch(error.code) {
						case error.PERMISSION_DENIED:
							console.log("User denied the request for Geolocation.");
							break;
						case error.POSITION_UNAVAILABLE:
							console.log("Location information is unavailable.");
							break;
						case error.TIMEOUT:
							console.log ("The request to get user location timed out.");
							break;
						case error.UNKNOWN_ERROR:
							console.log("An unknown error occurred.");
							break;
					}
				});*/
				var navigationControl = new BMap.NavigationControl({
					// 靠左上角位置
					anchor: BMAP_ANCHOR_BOTTOM_LEFT,
					// LARGE类型
					type: BMAP_NAVIGATION_CONTROL_LARGE,
					// 启用显示定位
					enableGeolocation: true // 会多出一个点
				});
				map.addControl(navigationControl);

				function getLocationCtrl() {
					this.defaultAnchor = BMAP_ANCHOR_BOTTOM_RIGHT;
					this.defaultOffset = new BMap.Size(10, 10);
				}

				getLocationCtrl.prototype = new BMap.Control();
				getLocationCtrl.prototype.initialize = function(map) {
					var div = document.createElement("div");
					// 添加文字说明
					div.appendChild(document.createTextNode("点击定位"));
					// 设置样式
					div.style.cursor = "pointer";
					div.style.border = "1px solid gray";
					div.style.backgroundColor = "white";
					/*div.onclick = function(e) {
						map.setZoom(map.getZoom() + 2);
						console.log("get");
					};*/
					div.addEventListener('tap', function(event) {
							console.log("tap event");
							var geolocation = new BMap.Geolocation();
							geolocation.getCurrentPosition(function(r) {
								if(this.getStatus() == BMAP_STATUS_SUCCESS) {
									map.clearOverlays();
									var imk = new BMap.Marker(r.point);
									map.addOverlay(imk);
									var label = new BMap.Label("您的位置", {
										offset: new BMap.Size(-5, -15)
									});
									imk.setLabel(label);
									map.panTo(r.point, 16);
									mui.getJSON(serverAddress, {
										lng: r.point.lng,
										lat: r.point.lat
									}, function(data) {

										for(var i = 0; i < data['length']; i++) {
											if(debug) console.log(data['datas'][i]['lng'] + "," + data['datas'][i]['lat']);
											var flag = new BMap.Point(data['datas'][i]['lng'], data['datas'][i]['lat']);
											var mk = new BMap.Marker(flag);
											map.addOverlay(mk);
											var label = new BMap.Label(data['datas'][i]['groupName'], {
												offset: new BMap.Size(-5, -15)
											});
											mk.setLabel(label);
										}
									}, 'json');

								}
							});
							/*plus.geolocation.getCurrentPosition(function(p) {
								var currentLon = p.coords.longitude;
								var currentLat = p.coords.latitude;
								var gpsPoint = new BMap.Point(currentLon, currentLat);
								map.panTo(gpsPoint);
								//BMap.Convertor.translate(gpsPoint, 15, function() {});
							});*/

						}),
						map.getContainer().appendChild(div);
					// 将DOM元素返回
					return div;
				};
				var myGetLocationCtrl = new getLocationCtrl();
				// 添加到地图当中
				map.addControl(myGetLocationCtrl);

			});
