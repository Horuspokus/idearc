const CLOUD_WORDS = [
  { label: '#IDEArc', weight: 26 },
  { label: '#IDEArccomtr', weight: 22 },
  { label: '#autodesk', weight: 18 },
  { label: '#infraworks', weight: 17 },
  { label: '#autocad', weight: 16 },
  { label: '#autocadcivil3d', weight: 20 },
  { label: '#roaddesign', weight: 15 },
  { label: '#roadsandhighways', weight: 14 },
  { label: '#trafficengineering', weight: 13 },
  { label: '#earthworks', weight: 12 },
  { label: '#BIM', weight: 24 }
];

function shuffleWords(words) {
  const items = [...words];

  for (let i = items.length - 1; i > 0; i -= 1) {
    const j = Math.floor(Math.random() * (i + 1));
    [items[i], items[j]] = [items[j], items[i]];
  }

  return items;
}

function hashString(value) {
  let hash = 0;
  for (let i = 0; i < value.length; i += 1) {
    hash = (hash << 5) - hash + value.charCodeAt(i);
    hash |= 0;
  }
  return Math.abs(hash);
}

function getWordColor(word, maxWeight) {
  const weightRatio = word.weight / maxWeight;
  const baseHue = 350 + (hashString(word.label) % 20);
  const saturation = 70 + weightRatio * 20;
  const lightness = 48 + weightRatio * 16;
  return `hsl(${baseHue}, ${saturation}%, ${lightness}%)`;
}


function renderHtmlCloud(container, words) {
  const fragment = document.createDocumentFragment();
  const maxWeight = Math.max(...words.map((word) => word.weight));

  container.innerHTML = '';
  words.forEach((word) => {
    const span = document.createElement('span');
    const size = 0.75 + (word.weight / maxWeight) * 0.75;
    span.textContent = word.label;
    span.style.fontSize = `${size.toFixed(2)}rem`;
    span.style.color = getWordColor(word, maxWeight);
    span.setAttribute('role', 'listitem');
    span.setAttribute('aria-label', word.label);

    fragment.appendChild(span);
  });

  container.appendChild(fragment);
}

export function initWordCloud() {
  const body = document.body;
  if (!body || body.dataset.page !== 'about') {
    return;
  }

  const htmlCloud = document.getElementById('wordCloudHtml');
  if (!htmlCloud) {
    return;
  }

  const words = shuffleWords(CLOUD_WORDS);
  renderHtmlCloud(htmlCloud, words);
}
