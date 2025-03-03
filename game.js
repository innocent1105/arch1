import * as THREE from 'three';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';


// Scene, Camera, Renderer
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(
  75,
  window.innerWidth / window.innerHeight,
  0.1,
  1000
);
camera.position.set(0, 15, 15);


// models

// GLTF Model Loader
const loader = new GLTFLoader();
loader.setPath('./models')
loader.load( "/free_magical_assassin.glb", function ( gltf ) {
    ninjaModel = gltf.scene.children[ 0 ];
    // flamingoMesh.rotation.y = -15;
    ninjaModel.position.set(0,1, 1);
    scene.add(ninjaModel);
} );

loader.load("/dodge_challenger_demon.glb", function ( gltf ) {
    carModel = gltf.scene.children[ 0 ];
    // flamingoMesh.rotation.y = -15;
    carModel.position.set(0,1, 4);
    scene.add(carModel);
    carModel.scale.set(1, 1, 1);
    scene.add(carModel);
} );

const moveDistance = 0.1; // Adjust speed

function onDocumentKeyDown(event) {
  if (!carModel) return;

  // Get the rotation in radians
  const angle = carModel.rotation.z;

  // Calculate the forward direction using trigonometry
  const forwardX = Math.sin(angle);
  const forwardY = -Math.cos(angle); // Negative because Three.js y-axis is flipped

  switch (event.key) {
    case 'ArrowUp':
      // Move forward in the direction the car is facing
      carModel.position.x += forwardX * moveDistance;
      // carModel.position.y += forwardY * moveDistance;
      break;
    case 'ArrowDown':
      // Move backward in the opposite direction
      carModel.position.x -= forwardX * moveDistance;
      carModel.position.y -= forwardY * moveDistance;
      break;
    case 'ArrowLeft':
      // Rotate left (Z-axis)
      carModel.rotation.z += THREE.MathUtils.degToRad(5);
      break;
    case 'ArrowRight':
      // Rotate right (Z-axis)
      carModel.rotation.z -= THREE.MathUtils.degToRad(5);
      break;
  }
}

document.addEventListener('keydown', onDocumentKeyDown);












// Renderer
const renderer = new THREE.WebGLRenderer({alpha: true });
renderer.setSize(window.innerWidth, window.innerHeight);
document.body.appendChild(renderer.domElement);

// OrbitControls
const controls = new OrbitControls(camera, renderer.domElement);
controls.enableDamping = true;
controls.dampingFactor = 0.05;
controls.screenSpacePanning = false;
controls.minDistance = 2;
controls.maxDistance = 50;
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
