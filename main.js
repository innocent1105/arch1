import * as THREE from 'three';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';
import { OBJLoader } from 'three/examples/jsm/loaders/OBJLoader.js';
import { MTLLoader } from 'three/examples/jsm/loaders/MTLLoader.js';
import { FBXLoader } from 'three/examples/jsm/loaders/FBXLoader.js';

// components
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

loader.load("/old_kings_head.glb", function ( gltf ) {
    carModel = gltf.scene.children[ 0 ];
    // flamingoMesh.rotation.y = -15;
    carModel.position.set(0,1, 4);
    scene.add(carModel);
    carModel.scale.set(1, 1, 1);
    scene.add(carModel);
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
