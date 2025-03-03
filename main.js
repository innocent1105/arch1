import * as THREE from 'three';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

// import * as THREE from 'https://unpkg.com/three@latest/build/three.module.js';
// import { WebGPURenderer } from 'https://unpkg.com/three@latest/examples/jsm/renderers/WebGPURenderer.js';

// components
let model_name = document.getElementById("model-name").value;
console.log(model_name)
let modelContainer = document.getElementById("container");
// Scene, Camera, Renderer
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(
  75,
  window.innerWidth / window.innerHeight,
  0.1,
  1000
);
camera.position.set(0, 15, 15); 

// // GLTF Model Loader
const loader = new GLTFLoader();





loader.setPath('./models')

loader.load("/" + model_name, function ( gltf ) {
    Model = gltf.scene.children[ 0 ];
    // flamingoMesh.rotation.y = -15;
    Model.position.set(0,0, 4);
    scene.add(Model);
    Model.scale.set(1, 1, 1);
    scene.add(Model);
} );







// Renderer
const renderer = new THREE.WebGLRenderer({alpha: true });
renderer.setSize(window.innerWidth, window.innerHeight);
modelContainer.appendChild(renderer.domElement);

// OrbitControls
const controls = new OrbitControls(camera, renderer.domElement);
controls.enableDamping = true;
controls.dampingFactor = 0.05;
controls.screenSpacePanning = false;
controls.minDistance = 2;
controls.maxDistance = 70;
controls.maxPolarAngle = Math.PI / 2;

// Lighting
const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
directionalLight.position.set(-50, 50, 0);
scene.add(directionalLight);

// Ground Plane
const planeGeometry = new THREE.PlaneGeometry(30, 30);
const planeMaterial = new THREE.MeshStandardMaterial({
  color: 0x444444,
  side: THREE.DoubleSide,
});
const plane = new THREE.Mesh(planeGeometry, planeMaterial);
plane.rotation.x = -Math.PI / 2;
scene.add(plane);

// Grid and Axes Helpers
scene.add(new THREE.GridHelper(20));
scene.add(new THREE.AxesHelper(5));

// Fog
scene.fog = new THREE.Fog(0xffffff, 0, 200);


// Animation Loop
function animate() {
  requestAnimationFrame(animate);
  controls.update();
  renderer.render(scene, camera);
}
animate();

// Window Resize Handling
window.addEventListener('resize', () => {
  camera.aspect = window.innerWidth / window.innerHeight;
  camera.updateProjectionMatrix();
  renderer.setSize(window.innerWidth, window.innerHeight);
});








