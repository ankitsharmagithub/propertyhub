/* ==========================================================================
   AUREATE ESTATES — Three.js Architectural Wireframe (hero accent)
   Lightweight abstract skyline of wireframe blocks. Mouse-parallax + scroll.
   Skips entirely on small screens / no WebGL / reduced motion.
   ========================================================================== */

(function () {
  const canvas = document.getElementById("hero-canvas");
  if (!canvas) return;

  const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  const isSmall = window.innerWidth < 768;
  if (reduceMotion || isSmall || typeof THREE === "undefined") {
    canvas.style.display = "none";
    return;
  }

  let renderer;
  try {
    renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
  } catch (e) {
    canvas.style.display = "none";
    return;
  }

  const scene = new THREE.Scene();
  const camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0.1, 100);
  camera.position.set(0, 1.4, 11);

  function resize() {
    const w = window.innerWidth, h = window.innerHeight;
    renderer.setSize(w, h);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 1.75));
    camera.aspect = w / h;
    camera.updateProjectionMatrix();
  }
  resize();

  const gold = 0xc9a227;
  const group = new THREE.Group();
  scene.add(group);

  // Abstract skyline of wireframe boxes
  const blockCount = 9;
  const blocks = [];
  for (let i = 0; i < blockCount; i++) {
    const w = THREE.MathUtils.randFloat(0.6, 1.3);
    const h = THREE.MathUtils.randFloat(1.5, 4.2);
    const d = THREE.MathUtils.randFloat(0.6, 1.3);
    const geo = new THREE.BoxGeometry(w, h, d);
    const edges = new THREE.EdgesGeometry(geo);
    const mat = new THREE.LineBasicMaterial({ color: gold, transparent: true, opacity: 0.38 });
    const line = new THREE.LineSegments(edges, mat);
    line.position.x = (i - blockCount / 2) * 1.55 + THREE.MathUtils.randFloat(-0.3, 0.3);
    line.position.y = h / 2 - 2.4;
    line.position.z = THREE.MathUtils.randFloat(-2, 1.5);
    group.add(line);
    blocks.push(line);
  }

  // Floating wireframe sphere (site marker abstraction)
  const sphereGeo = new THREE.IcosahedronGeometry(1.1, 1);
  const sphereEdges = new THREE.EdgesGeometry(sphereGeo);
  const sphereMat = new THREE.LineBasicMaterial({ color: 0xf5f2ea, transparent: true, opacity: 0.14 });
  const sphere = new THREE.LineSegments(sphereEdges, sphereMat);
  sphere.position.set(3.4, 1.2, -3);
  scene.add(sphere);

  let targetRotX = 0, targetRotY = 0;
  let mouseX = 0, mouseY = 0;

  window.addEventListener("mousemove", (e) => {
    mouseX = (e.clientX / window.innerWidth) * 2 - 1;
    mouseY = (e.clientY / window.innerHeight) * 2 - 1;
  }, { passive: true });

  let scrollFactor = 0;
  window.addEventListener("scroll", () => {
    scrollFactor = Math.min(window.scrollY / window.innerHeight, 1);
  }, { passive: true });

  window.addEventListener("resize", resize);

  const clock = new THREE.Clock();
  function animate() {
    requestAnimationFrame(animate);
    const t = clock.getElapsedTime();

    targetRotY += (mouseX * 0.25 - targetRotY) * 0.04;
    targetRotX += (mouseY * 0.12 - targetRotX) * 0.04;

    group.rotation.y = targetRotY + Math.sin(t * 0.05) * 0.05;
    group.rotation.x = targetRotX * 0.3;
    group.position.y = -scrollFactor * 1.6;

    sphere.rotation.y = t * 0.08;
    sphere.rotation.x = t * 0.05;

    camera.position.x = mouseX * 0.4;
    camera.lookAt(0, 0, 0);

    renderer.render(scene, camera);
  }
  animate();
})();
