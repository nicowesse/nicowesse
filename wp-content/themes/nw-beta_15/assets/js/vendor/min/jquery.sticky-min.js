!function(){function e(e){return{top:e.offsetTop,left:e.offsetLeft}}function t(t){var n,o,i,l,r,s,c,f={top:0,left:0},a=t&&t.ownerDocument;if(a)return(o=a.body)===t?e(t):(n=a.documentElement,"undefined"!=typeof t.getBoundingClientRect&&(f=t.getBoundingClientRect()),i=window,l=n.clientTop||o.clientTop||0,r=n.clientLeft||o.clientLeft||0,s=i.pageYOffset||n.scrollTop,c=i.pageXOffset||n.scrollLeft,{top:f.top+s-l,left:f.left+c-r})}function n(e,t){for(var n=e.getAttribute("style").split(";"),o=[],i=0,l=n.length;l>i;i++){var r=n[i].split(":"),s=r[0],c=r[1];o.push(s in t?s+":"+t[s]:r.join(":"))}e.setAttribute("style",o.join(";"))}function o(e){var n;for(e=e.replace(/(\/\*([\s\S]*?)\*\/)|(\/\/(.*)$)/gm,"").replace(/\n|\r/g,"");null!==(n=v.exec(e));){var o=n[1];if(y.test(n[2])&&"#modernizr"!==o){var i=h.exec(n[2]),l=null!==i?parseInt(i[1]):0,r=m.call(document.querySelectorAll(o));r.forEach(function(e){var o=e.offsetHeight,i=e.parentElement,r=t(i),s=null!==r&&null!==r.top?r.top:0,c=t(e),f=null!==c&&null!==c.top?c.top:0,a=f-l,u=s+i.offsetHeight-o-l,d=n[2]+"position:fixed;width:"+e.offsetWidth+"px;height:"+o+"px",p=document.createElement("div");p.innerHTML='<span style="position:static;display:block;height:'+o+'px;"></span>',w.push({element:e,parent:i,repl:p.firstElementChild,start:a,end:u,oldCSS:n[2],newCSS:d,fixed:!1})})}}}function i(){var e=c;f=!1;for(var o=0,i=w.length;i>o;o++){var l=w[o];if(l.fixed===!1&&e>l.start&&e<l.end)l.element.setAttribute("style",l.newCSS),l.fixed=!0,l.element.classList.add("stuck");else if(l.fixed===!0)if(e<l.start)l.element.setAttribute("style",l.oldCSS),l.fixed=!1,l.element.classList.remove("stuck");else if(e>l.end){var r=t(l.element);r.position="absolute",l.element.setAttribute("style",l.newCSS),n(l.element,r),l.fixed=!1,l.element.classList.remove("stuck")}}}function l(){c=document.documentElement.scrollTop||document.body.scrollTop,f||(f=!0,a?a(i):setTimeout(i,15))}for(var r=["","-webkit-","-ms-","-moz-","-o-"],s=document.createElement("div"),c=0,f=!1,a=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame,u=0,d=r.length;d>u;u++)try{s.style.position=r[u]+"sticky"}catch(p){return!1}var m=Array.prototype.slice,v=/\s*(.*?)\s*{(.*?)}+/g,y=/\.*?position:.*?sticky.*?;/i,h=/\.*?top:(.*?);/i,w=[];window.addEventListener("scroll",l),window.addEventListener("load",function(){var e=m.call(document.querySelectorAll("style"));e.forEach(function(e){var t=e.textContent||e.innerText;o(t)});var t=m.call(document.querySelectorAll("link"));t.forEach(function(e){if("stylesheet"===e.getAttribute("rel")){var t=e.getAttribute("href"),n=new XMLHttpRequest;n.open("GET",t,!0),n.onload=function(e){o(n.responseText),l()},n.send()}})},!1)}();