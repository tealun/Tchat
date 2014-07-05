define("common/qq/emoji.js", [ "widget/emoji.css" ], function(e, t, n) {
try {
var r = +(new Date);
e("widget/emoji.css");
var i = {
"☀": "2600",
"☁": "2601",
"☔": "2614",
"⛄": "26c4",
"⚡": "26a1",
"🌀": "1f300",
"🌁": "1f301",
"🌂": "1f302",
"🌃": "1f303",
"🌄": "1f304",
"🌅": "1f305",
"🌆": "1f306",
"🌇": "1f307",
"🌈": "1f308",
"❄": "2744",
"⛅": "26c5",
"🌉": "1f309",
"🌊": "1f30a",
"🌋": "1f30b",
"🌌": "1f30c",
"🌏": "1f30f",
"🌑": "1f311",
"🌔": "1f314",
"🌓": "1f313",
"🌙": "1f319",
"🌕": "1f315",
"🌛": "1f31b",
"🌟": "1f31f",
"🌠": "1f320",
"🕐": "1f550",
"🕑": "1f551",
"🕒": "1f552",
"🕓": "1f553",
"🕔": "1f554",
"🕕": "1f555",
"🕖": "1f556",
"🕗": "1f557",
"🕘": "1f558",
"🕙": "1f559",
"🕚": "1f55a",
"🕛": "1f55b",
"⌚": "231a",
"⌛": "231b",
"⏰": "23f0",
"⏳": "23f3",
"♈": "2648",
"♉": "2649",
"♊": "264a",
"♋": "264b",
"♌": "264c",
"♍": "264d",
"♎": "264e",
"♏": "264f",
"♐": "2650",
"♑": "2651",
"♒": "2652",
"♓": "2653",
"⛎": "26ce",
"🍀": "1f340",
"🌷": "1f337",
"🌱": "1f331",
"🍁": "1f341",
"🌸": "1f338",
"🌹": "1f339",
"🍂": "1f342",
"🍃": "1f343",
"🌺": "1f33a",
"🌻": "1f33b",
"🌴": "1f334",
"🌵": "1f335",
"🌾": "1f33e",
"🌽": "1f33d",
"🍄": "1f344",
"🌰": "1f330",
"🌼": "1f33c",
"🌿": "1f33f",
"🍒": "1f352",
"🍌": "1f34c",
"🍎": "1f34e",
"🍊": "1f34a",
"🍓": "1f353",
"🍉": "1f349",
"🍅": "1f345",
"🍆": "1f346",
"🍈": "1f348",
"🍍": "1f34d",
"🍇": "1f347",
"🍑": "1f351",
"🍏": "1f34f",
"👀": "1f440",
"👂": "1f442",
"👃": "1f443",
"👄": "1f444",
"👅": "1f445",
"💄": "1f484",
"💅": "1f485",
"💆": "1f486",
"💇": "1f487",
"💈": "1f488",
"👤": "1f464",
"👦": "1f466",
"👧": "1f467",
"👨": "1f468",
"👩": "1f469",
"👪": "1f46a",
"👫": "1f46b",
"👮": "1f46e",
"👯": "1f46f",
"👰": "1f470",
"👱": "1f471",
"👲": "1f472",
"👳": "1f473",
"👴": "1f474",
"👵": "1f475",
"👶": "1f476",
"👷": "1f477",
"👸": "1f478",
"👹": "1f479",
"👺": "1f47a",
"👻": "1f47b",
"👼": "1f47c",
"👽": "1f47d",
"👾": "1f47e",
"👿": "1f47f",
"💀": "1f480",
"💁": "1f481",
"💂": "1f482",
"💃": "1f483",
"🐌": "1f40c",
"🐍": "1f40d",
"🐎": "1f40e",
"🐔": "1f414",
"🐗": "1f417",
"🐫": "1f42b",
"🐘": "1f418",
"🐨": "1f428",
"🐒": "1f412",
"🐑": "1f411",
"🐙": "1f419",
"🐚": "1f41a",
"🐛": "1f41b",
"🐜": "1f41c",
"🐝": "1f41d",
"🐞": "1f41e",
"🐠": "1f420",
"🐡": "1f421",
"🐢": "1f422",
"🐤": "1f424",
"🐥": "1f425",
"🐦": "1f426",
"🐣": "1f423",
"🐧": "1f427",
"🐩": "1f429",
"🐟": "1f41f",
"🐬": "1f42c",
"🐭": "1f42d",
"🐯": "1f42f",
"🐱": "1f431",
"🐳": "1f433",
"🐴": "1f434",
"🐵": "1f435",
"🐶": "1f436",
"🐷": "1f437",
"🐻": "1f43b",
"🐹": "1f439",
"🐺": "1f43a",
"🐮": "1f42e",
"🐰": "1f430",
"🐸": "1f438",
"🐾": "1f43e",
"🐲": "1f432",
"🐼": "1f43c",
"🐽": "1f43d",
"😠": "1f620",
"😩": "1f629",
"😲": "1f632",
"😞": "1f61e",
"😵": "1f635",
"😰": "1f630",
"😒": "1f612",
"😍": "1f60d",
"😤": "1f624",
"😜": "1f61c",
"😝": "1f61d",
"😋": "1f60b",
"😘": "1f618",
"😚": "1f61a",
"😷": "1f637",
"😳": "1f633",
"😃": "1f603",
"😅": "1f605",
"😆": "1f606",
"😁": "1f601",
"😂": "1f602",
"😊": "1f60a",
"☺": "263a",
"😄": "1f604",
"😢": "1f622",
"😭": "1f62d",
"😨": "1f628",
"😣": "1f623",
"😡": "1f621",
"😌": "1f60c",
"😖": "1f616",
"😔": "1f614",
"😱": "1f631",
"😪": "1f62a",
"😏": "1f60f",
"😓": "1f613",
"😥": "1f625",
"😫": "1f62b",
"😉": "1f609",
"😺": "1f63a",
"😸": "1f638",
"😹": "1f639",
"😽": "1f63d",
"😻": "1f63b",
"😿": "1f63f",
"😾": "1f63e",
"😼": "1f63c",
"🙀": "1f640",
"🙅": "1f645",
"🙆": "1f646",
"🙇": "1f647",
"🙈": "1f648",
"🙊": "1f64a",
"🙉": "1f649",
"🙋": "1f64b",
"🙌": "1f64c",
"🙍": "1f64d",
"🙎": "1f64e",
"🙏": "1f64f",
"🏠": "1f3e0",
"🏡": "1f3e1",
"🏢": "1f3e2",
"🏣": "1f3e3",
"🏥": "1f3e5",
"🏦": "1f3e6",
"🏧": "1f3e7",
"🏨": "1f3e8",
"🏩": "1f3e9",
"🏪": "1f3ea",
"🏫": "1f3eb",
"⛪": "26ea",
"⛲": "26f2",
"🏬": "1f3ec",
"🏯": "1f3ef",
"🏰": "1f3f0",
"🏭": "1f3ed",
"⚓": "2693",
"🏮": "1f3ee",
"🗻": "1f5fb",
"🗼": "1f5fc",
"🗽": "1f5fd",
"🗾": "1f5fe",
"🗿": "1f5ff",
"👞": "1f45e",
"👟": "1f45f",
"👠": "1f460",
"👡": "1f461",
"👢": "1f462",
"👣": "1f463",
"👓": "1f453",
"👕": "1f455",
"👖": "1f456",
"👑": "1f451",
"👔": "1f454",
"👒": "1f452",
"👗": "1f457",
"👘": "1f458",
"👙": "1f459",
"👚": "1f45a",
"👛": "1f45b",
"👜": "1f45c",
"👝": "1f45d",
"💰": "1f4b0",
"💱": "1f4b1",
"💹": "1f4b9",
"💲": "1f4b2",
"💳": "1f4b3",
"💴": "1f4b4",
"💵": "1f4b5",
"💸": "1f4b8",
"🇨🇳": "1f1e81f1f3",
"🇩🇪": "1f1e91f1ea",
"🇪🇸": "1f1ea1f1f8",
"🇫🇷": "1f1eb1f1f7",
"🇬🇧": "1f1ec1f1e7",
"🇮🇹": "1f1ee1f1f9",
"🇯🇵": "1f1ef1f1f5",
"🇰🇷": "1f1f01f1f7",
"🇷🇺": "1f1f71f1fa",
"🇺🇸": "1f1fa1f1f8",
"🔥": "1f525",
"🔦": "1f526",
"🔧": "1f527",
"🔨": "1f528",
"🔩": "1f529",
"🔪": "1f52a",
"🔫": "1f52b",
"🔮": "1f52e",
"🔯": "1f52f",
"🔰": "1f530",
"🔱": "1f531",
"💉": "1f489",
"💊": "1f48a",
"🅰": "1f170",
"🅱": "1f171",
"🆎": "1f18e",
"🅾": "1f17e",
"🎀": "1f380",
"🎁": "1f381",
"🎂": "1f382",
"🎄": "1f384",
"🎅": "1f385",
"🎌": "1f38c",
"🎆": "1f386",
"🎈": "1f388",
"🎉": "1f389",
"🎍": "1f38d",
"🎎": "1f38e",
"🎓": "1f393",
"🎒": "1f392",
"🎏": "1f38f",
"🎇": "1f387",
"🎐": "1f390",
"🎃": "1f383",
"🎊": "1f38a",
"🎋": "1f38b",
"🎑": "1f391",
"📟": "1f4df",
"☎": "260e",
"📞": "1f4de",
"📱": "1f4f1",
"📲": "1f4f2",
"📝": "1f4dd",
"📠": "1f4e0",
"✉": "2709",
"📨": "1f4e8",
"📩": "1f4e9",
"📪": "1f4ea",
"📫": "1f4eb",
"📮": "1f4ee",
"📰": "1f4f0",
"📢": "1f4e2",
"📣": "1f4e3",
"📡": "1f4e1",
"📤": "1f4e4",
"📥": "1f4e5",
"📦": "1f4e6",
"📧": "1f4e7",
"🔠": "1f520",
"🔡": "1f521",
"🔢": "1f522",
"🔣": "1f523",
"🔤": "1f524",
"✒": "2712",
"💺": "1f4ba",
"💻": "1f4bb",
"✏": "270f",
"📎": "1f4ce",
"💼": "1f4bc",
"💽": "1f4bd",
"💾": "1f4be",
"💿": "1f4bf",
"📀": "1f4c0",
"✂": "2702",
"📍": "1f4cd",
"📃": "1f4c3",
"📄": "1f4c4",
"📅": "1f4c5",
"📁": "1f4c1",
"📂": "1f4c2",
"📓": "1f4d3",
"📖": "1f4d6",
"📔": "1f4d4",
"📕": "1f4d5",
"📗": "1f4d7",
"📘": "1f4d8",
"📙": "1f4d9",
"📚": "1f4da",
"📛": "1f4db",
"📜": "1f4dc",
"📋": "1f4cb",
"📆": "1f4c6",
"📊": "1f4ca",
"📈": "1f4c8",
"📉": "1f4c9",
"📇": "1f4c7",
"📌": "1f4cc",
"📒": "1f4d2",
"📏": "1f4cf",
"📐": "1f4d0",
"📑": "1f4d1",
"🎽": "1f3bd",
"⚾": "26be",
"⛳": "26f3",
"🎾": "1f3be",
"⚽": "26bd",
"🎿": "1f3bf",
"🏀": "1f3c0",
"🏁": "1f3c1",
"🏂": "1f3c2",
"🏃": "1f3c3",
"🏄": "1f3c4",
"🏆": "1f3c6",
"🏈": "1f3c8",
"🏊": "1f3ca",
"🚃": "1f683",
"🚇": "1f687",
"Ⓜ": "24c2",
"🚄": "1f684",
"🚅": "1f685",
"🚗": "1f697",
"🚙": "1f699",
"🚌": "1f68c",
"🚏": "1f68f",
"🚢": "1f6a2",
"✈": "2708",
"⛵": "26f5",
"🚉": "1f689",
"🚀": "1f680",
"🚤": "1f6a4",
"🚕": "1f695",
"🚚": "1f69a",
"🚒": "1f692",
"🚑": "1f691",
"🚓": "1f693",
"⛽": "26fd",
"🅿": "1f17f",
"🚥": "1f6a5",
"🚧": "1f6a7",
"🚨": "1f6a8",
"♨": "2668",
"⛺": "26fa",
"🎠": "1f3a0",
"🎡": "1f3a1",
"🎢": "1f3a2",
"🎣": "1f3a3",
"🎤": "1f3a4",
"🎥": "1f3a5",
"🎦": "1f3a6",
"🎧": "1f3a7",
"🎨": "1f3a8",
"🎩": "1f3a9",
"🎪": "1f3aa",
"🎫": "1f3ab",
"🎬": "1f3ac",
"🎭": "1f3ad",
"🎮": "1f3ae",
"🀄": "1f004",
"🎯": "1f3af",
"🎰": "1f3b0",
"🎱": "1f3b1",
"🎲": "1f3b2",
"🎳": "1f3b3",
"🎴": "1f3b4",
"🃏": "1f0cf",
"🎵": "1f3b5",
"🎶": "1f3b6",
"🎷": "1f3b7",
"🎸": "1f3b8",
"🎹": "1f3b9",
"🎺": "1f3ba",
"🎻": "1f3bb",
"🎼": "1f3bc",
"〽": "303d",
"📷": "1f4f7",
"📹": "1f4f9",
"📺": "1f4fa",
"📻": "1f4fb",
"📼": "1f4fc",
"💋": "1f48b",
"💌": "1f48c",
"💍": "1f48d",
"💎": "1f48e",
"💏": "1f48f",
"💐": "1f490",
"💑": "1f491",
"💒": "1f492",
"🔞": "1f51e",
"©": "a9",
"®": "ae",
"™": "2122",
"ℹ": "2139",
"#⃣": "2320e3",
"1⃣": "3120e3",
"2⃣": "3220e3",
"3⃣": "3320e3",
"4⃣": "3420e3",
"5⃣": "3520e3",
"6⃣": "3620e3",
"7⃣": "3720e3",
"8⃣": "3820e3",
"9⃣": "3920e3",
"0⃣": "3020e3",
"🔟": "1f51f",
"📶": "1f4f6",
"📳": "1f4f3",
"📴": "1f4f4",
"🍔": "1f354",
"🍙": "1f359",
"🍰": "1f370",
"🍜": "1f35c",
"🍞": "1f35e",
"🍳": "1f373",
"🍦": "1f366",
"🍟": "1f35f",
"🍡": "1f361",
"🍘": "1f358",
"🍚": "1f35a",
"🍝": "1f35d",
"🍛": "1f35b",
"🍢": "1f362",
"🍣": "1f363",
"🍱": "1f371",
"🍲": "1f372",
"🍧": "1f367",
"🍖": "1f356",
"🍥": "1f365",
"🍠": "1f360",
"🍕": "1f355",
"🍗": "1f357",
"🍨": "1f368",
"🍩": "1f369",
"🍪": "1f36a",
"🍫": "1f36b",
"🍬": "1f36c",
"🍭": "1f36d",
"🍮": "1f36e",
"🍯": "1f36f",
"🍤": "1f364",
"🍴": "1f374",
"☕": "2615",
"🍸": "1f378",
"🍺": "1f37a",
"🍵": "1f375",
"🍶": "1f376",
"🍷": "1f377",
"🍻": "1f37b",
"🍹": "1f379",
"↗": "2197",
"↘": "2198",
"↖": "2196",
"↙": "2199",
"⤴": "2934",
"⤵": "2935",
"↔": "2194",
"↕": "2195",
"⬆": "2b06",
"⬇": "2b07",
"➡": "27a1",
"⬅": "2b05",
"▶": "25b6",
"◀": "25c0",
"⏩": "23e9",
"⏪": "23ea",
"⏫": "23eb",
"⏬": "23ec",
"🔺": "1f53a",
"🔻": "1f53b",
"🔼": "1f53c",
"🔽": "1f53d",
"⭕": "2b55",
"❌": "274c",
"❎": "274e",
"❗": "2757",
"⁉": "2049",
"‼": "203c",
"❓": "2753",
"❔": "2754",
"❕": "2755",
"〰": "3030",
"➰": "27b0",
"➿": "27bf",
"❤": "2764",
"💓": "1f493",
"💔": "1f494",
"💕": "1f495",
"💖": "1f496",
"💗": "1f497",
"💘": "1f498",
"💙": "1f499",
"💚": "1f49a",
"💛": "1f49b",
"💜": "1f49c",
"💝": "1f49d",
"💞": "1f49e",
"💟": "1f49f",
"♥": "2665",
"♠": "2660",
"♦": "2666",
"♣": "2663",
"🚬": "1f6ac",
"🚭": "1f6ad",
"♿": "267f",
"🚩": "1f6a9",
"⚠": "26a0",
"⛔": "26d4",
"♻": "267b",
"🚲": "1f6b2",
"🚶": "1f6b6",
"🚹": "1f6b9",
"🚺": "1f6ba",
"🛀": "1f6c0",
"🚻": "1f6bb",
"🚽": "1f6bd",
"🚾": "1f6be",
"🚼": "1f6bc",
"🚪": "1f6aa",
"🚫": "1f6ab",
"✔": "2714",
"🆑": "1f191",
"🆒": "1f192",
"🆓": "1f193",
"🆔": "1f194",
"🆕": "1f195",
"🆖": "1f196",
"🆗": "1f197",
"🆘": "1f198",
"🆙": "1f199",
"🆚": "1f19a",
"🈁": "1f201",
"🈂": "1f202",
"🈲": "1f232",
"🈳": "1f233",
"🈴": "1f234",
"🈵": "1f235",
"🈶": "1f236",
"🈚": "1f21a",
"🈷": "1f237",
"🈸": "1f238",
"🈹": "1f239",
"🈯": "1f22f",
"🈺": "1f23a",
"㊙": "3299",
"㊗": "3297",
"🉐": "1f250",
"🉑": "1f251",
"➕": "2795",
"➖": "2796",
"✖": "2716",
"➗": "2797",
"💠": "1f4a0",
"💡": "1f4a1",
"💢": "1f4a2",
"💣": "1f4a3",
"💤": "1f4a4",
"💥": "1f4a5",
"💦": "1f4a6",
"💧": "1f4a7",
"💨": "1f4a8",
"💩": "1f4a9",
"💪": "1f4aa",
"💫": "1f4ab",
"💬": "1f4ac",
"✨": "2728",
"✴": "2734",
"✳": "2733",
"⚪": "26aa",
"⚫": "26ab",
"🔴": "1f534",
"🔵": "1f535",
"🔲": "1f532",
"🔳": "1f533",
"⭐": "2b50",
"⬜": "2b1c",
"⬛": "2b1b",
"▫": "25ab",
"▪": "25aa",
"◽": "25fd",
"◾": "25fe",
"◻": "25fb",
"◼": "25fc",
"🔶": "1f536",
"🔷": "1f537",
"🔸": "1f538",
"🔹": "1f539",
"❇": "2747",
"💮": "1f4ae",
"💯": "1f4af",
"↩": "21a9",
"↪": "21aa",
"🔃": "1f503",
"🔊": "1f50a",
"🔋": "1f50b",
"🔌": "1f50c",
"🔍": "1f50d",
"🔎": "1f50e",
"🔒": "1f512",
"🔓": "1f513",
"🔏": "1f50f",
"🔐": "1f510",
"🔑": "1f511",
"🔔": "1f514",
"☑": "2611",
"🔘": "1f518",
"🔖": "1f516",
"🔗": "1f517",
"🔙": "1f519",
"🔚": "1f51a",
"🔛": "1f51b",
"🔜": "1f51c",
"🔝": "1f51d",
" ": "2003",
" ": "2002",
" ": "2005",
"✅": "2705",
"✊": "270a",
"✋": "270b",
"✌": "270c",
"👊": "1f44a",
"👍": "1f44d",
"☝": "261d",
"👆": "1f446",
"👇": "1f447",
"👈": "1f448",
"👉": "1f449",
"👋": "1f44b",
"👏": "1f44f",
"👌": "1f44c",
"👎": "1f44e",
"👐": "1f450",
"": "2600",
"": "2601",
"": "2614",
"": "26c4",
"": "26a1",
"": "1f300",
"[霧]": "1f301",
"": "1f302",
"": "1f30c",
"": "1f304",
"": "1f305",
"": "1f306",
"": "1f307",
"": "1f308",
"[雪結晶]": "2744",
"": "26c5",
"": "1f30a",
"[火山]": "1f30b",
"[地球]": "1f30f",
"●": "1f311",
"": "1f31b",
"○": "1f315",
"": "1f31f",
"☆彡": "1f320",
"": "1f550",
"": "1f551",
"": "1f552",
"": "1f553",
"": "1f554",
"": "1f555",
"": "1f556",
"": "1f557",
"": "1f558",
"": "23f0",
"": "1f55a",
"": "1f55b",
"[腕時計]": "231a",
"[砂時計]": "23f3",
"": "2648",
"": "2649",
"": "264a",
"": "264b",
"": "264c",
"": "264d",
"": "264e",
"": "264f",
"": "2650",
"": "2651",
"": "2652",
"": "2653",
"": "26ce",
"": "1f33f",
"": "1f337",
"": "1f341",
"": "1f338",
"": "1f339",
"": "1f342",
"": "1f343",
"": "1f33a",
"": "1f33c",
"": "1f334",
"": "1f335",
"": "1f33e",
"[とうもろこし]": "1f33d",
"[キノコ]": "1f344",
"[栗]": "1f330",
"[さくらんぼ]": "1f352",
"[バナナ]": "1f34c",
"": "1f34f",
"": "1f34a",
"": "1f353",
"": "1f349",
"": "1f345",
"": "1f346",
"[メロン]": "1f348",
"[パイナップル]": "1f34d",
"[ブドウ]": "1f347",
"[モモ]": "1f351",
"": "1f440",
"": "1f442",
"": "1f443",
"": "1f444",
"": "1f61d",
"": "1f484",
"": "1f485",
"": "1f486",
"": "1f487",
"": "1f488",
"〓": "2005",
"": "1f466",
"": "1f467",
"": "1f468",
"": "1f469",
"[家族]": "1f46a",
"": "1f46b",
"": "1f46e",
"": "1f46f",
"[花嫁]": "1f470",
"": "1f471",
"": "1f472",
"": "1f473",
"": "1f474",
"": "1f475",
"": "1f476",
"": "1f477",
"": "1f478",
"[なまはげ]": "1f479",
"[天狗]": "1f47a",
"": "1f47b",
"": "1f47c",
"": "1f47d",
"": "1f47e",
"": "1f47f",
"": "1f480",
"": "1f481",
"": "1f482",
"": "1f483",
"[カタツムリ]": "1f40c",
"": "1f40d",
"": "1f40e",
"": "1f414",
"": "1f417",
"": "1f42b",
"": "1f418",
"": "1f428",
"": "1f412",
"": "1f411",
"": "1f419",
"": "1f41a",
"": "1f41b",
"[アリ]": "1f41c",
"[ミツバチ]": "1f41d",
"[てんとう虫]": "1f41e",
"": "1f420",
"": "1f3a3",
"[カメ]": "1f422",
"": "1f423",
"": "1f426",
"": "1f427",
"": "1f436",
"": "1f42c",
"": "1f42d",
"": "1f42f",
"": "1f431",
"": "1f433",
"": "1f434",
"": "1f435",
"": "1f43d",
"": "1f43b",
"": "1f439",
"": "1f43a",
"": "1f42e",
"": "1f430",
"": "1f438",
"": "1f463",
"[辰]": "1f432",
"[パンダ]": "1f43c",
"": "1f620",
"": "1f64d",
"": "1f632",
"": "1f61e",
"": "1f62b",
"": "1f630",
"": "1f612",
"": "1f63b",
"": "1f63c",
"": "1f61c",
"": "1f60a",
"": "1f63d",
"": "1f61a",
"": "1f637",
"": "1f633",
"": "1f63a",
"": "1f605",
"": "1f60c",
"": "1f639",
"": "263a",
"": "1f604",
"": "1f63f",
"": "1f62d",
"": "1f628",
"": "1f64e",
"": "1f4ab",
"": "1f631",
"": "1f62a",
"": "1f60f",
"": "1f613",
"": "1f625",
"": "1f609",
"": "1f645",
"": "1f646",
"": "1f647",
"(/_＼)": "1f648",
"(・×・)": "1f64a",
"|(・×・)|": "1f649",
"": "270b",
"": "1f64c",
"": "1f64f",
"": "1f3e1",
"": "1f3e2",
"": "1f3e3",
"": "1f3e5",
"": "1f3e6",
"": "1f3e7",
"": "1f3e8",
"": "1f3e9",
"": "1f3ea",
"": "1f3eb",
"": "26ea",
"": "26f2",
"": "1f3ec",
"": "1f3ef",
"": "1f3f0",
"": "1f3ed",
"": "1f6a2",
"": "1f376",
"": "1f5fb",
"": "1f5fc",
"": "1f5fd",
"[日本地図]": "1f5fe",
"[モアイ]": "1f5ff",
"": "1f45f",
"": "1f460",
"": "1f461",
"": "1f462",
"[メガネ]": "1f453",
"": "1f45a",
"[ジーンズ]": "1f456",
"": "1f451",
"": "1f454",
"": "1f452",
"": "1f457",
"": "1f458",
"": "1f459",
"[財布]": "1f45b",
"": "1f45c",
"[ふくろ]": "1f45d",
"": "1f4b5",
"": "1f4b1",
"": "1f4c8",
"[カード]": "1f4b3",
"￥": "1f4b4",
"[飛んでいくお金]": "1f4b8",
"": "1f1e81f1f3",
"": "1f1e91f1ea",
"": "1f1ea1f1f8",
"": "1f1eb1f1f7",
"": "1f1ec1f1e7",
"": "1f1ee1f1f9",
"": "1f1ef1f1f5",
"": "1f1f01f1f7",
"": "1f1f71f1fa",
"": "1f1fa1f1f8",
"": "1f525",
"[懐中電灯]": "1f526",
"[レンチ]": "1f527",
"": "1f528",
"[ネジ]": "1f529",
"[包丁]": "1f52a",
"": "1f52b",
"": "1f52f",
"": "1f530",
"": "1f531",
"": "1f489",
"": "1f48a",
"": "1f170",
"": "1f171",
"": "1f18e",
"": "1f17e",
"": "1f380",
"": "1f4e6",
"": "1f382",
"": "1f384",
"": "1f385",
"": "1f38c",
"": "1f386",
"": "1f388",
"": "1f389",
"": "1f38d",
"": "1f38e",
"": "1f393",
"": "1f392",
"": "1f38f",
"": "1f387",
"": "1f390",
"": "1f383",
"[オメデトウ]": "1f38a",
"[七夕]": "1f38b",
"": "1f391",
"[ポケベル]": "1f4df",
"": "1f4de",
"": "1f4f1",
"": "1f4f2",
"": "1f4d1",
"": "1f4e0",
"": "1f4e7",
"": "1f4eb",
"": "1f4ee",
"[新聞]": "1f4f0",
"": "1f4e2",
"": "1f4e3",
"": "1f4e1",
"[送信BOX]": "1f4e4",
"[受信BOX]": "1f4e5",
"[ABCD]": "1f520",
"[abcd]": "1f521",
"[1234]": "1f522",
"[記号]": "1f523",
"[ABC]": "1f524",
"[ペン]": "2712",
"": "1f4ba",
"": "1f4bb",
"[クリップ]": "1f4ce",
"": "1f4bc",
"": "1f4be",
"": "1f4bf",
"": "1f4c0",
"": "2702",
"[画びょう]": "1f4cc",
"[カレンダー]": "1f4c6",
"[フォルダ]": "1f4c2",
"": "1f4d2",
"[名札]": "1f4db",
"[スクロール]": "1f4dc",
"[グラフ]": "1f4c9",
"[定規]": "1f4cf",
"[三角定規]": "1f4d0",
"": "26be",
"": "26f3",
"": "1f3be",
"": "26bd",
"": "1f3bf",
"": "1f3c0",
"": "1f3c1",
"[スノボ]": "1f3c2",
"": "1f3c3",
"": "1f3c4",
"": "1f3c6",
"": "1f3c8",
"": "1f3ca",
"": "1f683",
"": "24c2",
"": "1f684",
"": "1f685",
"": "1f697",
"": "1f699",
"": "1f68c",
"": "1f68f",
"": "2708",
"": "26f5",
"": "1f689",
"": "1f680",
"": "1f6a4",
"": "1f695",
"": "1f69a",
"": "1f692",
"": "1f691",
"": "1f6a8",
"": "26fd",
"": "1f17f",
"": "1f6a5",
"": "26d4",
"": "2668",
"": "26fa",
"": "1f3a1",
"": "1f3a2",
"": "1f3a4",
"": "1f4f9",
"": "1f3a6",
"": "1f3a7",
"": "1f3a8",
"": "1f3ad",
"[イベント]": "1f3aa",
"": "1f3ab",
"": "1f3ac",
"[ゲーム]": "1f3ae",
"": "1f004",
"": "1f3af",
"": "1f3b0",
"": "1f3b1",
"[サイコロ]": "1f3b2",
"[ボーリング]": "1f3b3",
"[花札]": "1f3b4",
"[ジョーカー]": "1f0cf",
"": "1f3b5",
"": "1f3bc",
"": "1f3b7",
"": "1f3b8",
"[ピアノ]": "1f3b9",
"": "1f3ba",
"[バイオリン]": "1f3bb",
"": "303d",
"": "1f4f7",
"": "1f4fa",
"": "1f4fb",
"": "1f4fc",
"": "1f48b",
"": "1f48c",
"": "1f48d",
"": "1f48e",
"": "1f48f",
"": "1f490",
"": "1f491",
"": "1f492",
"": "1f51e",
"": "a9",
"": "ae",
"": "2122",
"[ｉ]": "2139",
"": "2320e3",
"": "3120e3",
"": "3220e3",
"": "3320e3",
"": "3420e3",
"": "3520e3",
"": "3620e3",
"": "3720e3",
"": "3820e3",
"": "3920e3",
"": "3020e3",
"[10]": "1f51f",
"": "1f4f6",
"": "1f4f3",
"": "1f4f4",
"": "1f354",
"": "1f359",
"": "1f370",
"": "1f35c",
"": "1f35e",
"": "1f373",
"": "1f366",
"": "1f35f",
"": "1f361",
"": "1f358",
"": "1f35a",
"": "1f35d",
"": "1f35b",
"": "1f362",
"": "1f363",
"": "1f371",
"": "1f372",
"": "1f367",
"[肉]": "1f356",
"[なると]": "1f365",
"[やきいも]": "1f360",
"[ピザ]": "1f355",
"[チキン]": "1f357",
"[アイスクリーム]": "1f368",
"[ドーナツ]": "1f369",
"[クッキー]": "1f36a",
"[チョコ]": "1f36b",
"[キャンディ]": "1f36d",
"[プリン]": "1f36e",
"[ハチミツ]": "1f36f",
"[エビフライ]": "1f364",
"": "1f374",
"": "2615",
"": "1f379",
"": "1f37a",
"": "1f375",
"": "1f37b",
"": "2934",
"": "2935",
"": "2196",
"": "2199",
"⇔": "2194",
"↑↓": "1f503",
"": "2b06",
"": "2b07",
"": "27a1",
"": "1f519",
"": "25b6",
"": "25c0",
"": "23e9",
"": "23ea",
"▲": "1f53c",
"▼": "1f53d",
"": "2b55",
"": "2716",
"": "2757",
"！？": "2049",
"！！": "203c",
"": "2753",
"": "2754",
"": "2755",
"～": "27b0",
"": "27bf",
"": "2764",
"": "1f49e",
"": "1f494",
"": "1f497",
"": "1f498",
"": "1f499",
"": "1f49a",
"": "1f49b",
"": "1f49c",
"": "1f49d",
"": "1f49f",
"": "2665",
"": "2660",
"": "2666",
"": "2663",
"": "1f6ac",
"": "1f6ad",
"": "267f",
"[旗]": "1f6a9",
"": "26a0",
"": "1f6b2",
"": "1f6b6",
"": "1f6b9",
"": "1f6ba",
"": "1f6c0",
"": "1f6bb",
"": "1f6bd",
"": "1f6be",
"": "1f6bc",
"[ドア]": "1f6aa",
"[禁止]": "1f6ab",
"[チェックマーク]": "2705",
"[CL]": "1f191",
"": "1f192",
"[FREE]": "1f193",
"": "1f194",
"": "1f195",
"[NG]": "1f196",
"": "1f197",
"[SOS]": "1f198",
"": "1f199",
"": "1f19a",
"": "1f201",
"": "1f202",
"[禁]": "1f232",
"": "1f233",
"[合]": "1f234",
"": "1f235",
"": "1f236",
"": "1f21a",
"": "1f237",
"": "1f238",
"": "1f239",
"": "1f22f",
"": "1f23a",
"": "3299",
"": "3297",
"": "1f250",
"[可]": "1f251",
"[＋]": "2795",
"[－]": "2796",
"[÷]": "2797",
"": "1f4a1",
"": "1f4a2",
"": "1f4a3",
"": "1f4a4",
"[ドンッ]": "1f4a5",
"": "1f4a7",
"": "1f4a8",
"": "1f4a9",
"": "1f4aa",
"[フキダシ]": "1f4ac",
"": "2747",
"": "2734",
"": "2733",
"": "1f534",
"": "25fc",
"": "1f539",
"": "2b50",
"[花丸]": "1f4ae",
"[100点]": "1f4af",
"←┘": "21a9",
"└→": "21aa",
"": "1f50a",
"[電池]": "1f50b",
"[コンセント]": "1f50c",
"": "1f50e",
"": "1f510",
"": "1f513",
"": "1f511",
"": "1f514",
"[ラジオボタン]": "1f518",
"[ブックマーク]": "1f516",
"[リンク]": "1f517",
"[end]": "1f51a",
"[ON]": "1f51b",
"[SOON]": "1f51c",
"": "1f51d",
"": "270a",
"": "270c",
"": "1f44a",
"": "1f44d",
"": "261d",
"": "1f446",
"": "1f447",
"": "1f448",
"": "1f449",
"": "1f44b",
"": "1f44f",
"": "1f44c",
"": "1f44e",
"": "1f450"
}, s = {
"/微笑": "0",
"/撇嘴": "1",
"/色": "2",
"/发呆": "3",
"/得意": "4",
"/流泪": "5",
"/害羞": "6",
"/闭嘴": "7",
"/睡": "8",
"/大哭": "9",
"/尴尬": "10",
"/发怒": "11",
"/调皮": "12",
"/呲牙": "13",
"/惊讶": "14",
"/难过": "15",
"/酷": "16",
"/冷汗": "17",
"/抓狂": "18",
"/吐": "19",
"/偷笑": "20",
"/可爱": "21",
"/白眼": "22",
"/傲慢": "23",
"/饥饿": "24",
"/困": "25",
"/惊恐": "26",
"/流汗": "27",
"/憨笑": "28",
"/大兵": "29",
"/奋斗": "30",
"/咒骂": "31",
"/疑问": "32",
"/嘘": "33",
"/晕": "34",
"/折磨": "35",
"/衰": "36",
"/骷髅": "37",
"/敲打": "38",
"/再见": "39",
"/擦汗": "40",
"/抠鼻": "41",
"/鼓掌": "42",
"/糗大了": "43",
"/坏笑": "44",
"/左哼哼": "45",
"/右哼哼": "46",
"/哈欠": "47",
"/鄙视": "48",
"/委屈": "49",
"/快哭了": "50",
"/阴险": "51",
"/亲亲": "52",
"/吓": "53",
"/可怜": "54",
"/菜刀": "55",
"/西瓜": "56",
"/啤酒": "57",
"/篮球": "58",
"/乒乓": "59",
"/咖啡": "60",
"/饭": "61",
"/猪头": "62",
"/玫瑰": "63",
"/凋谢": "64",
"/示爱": "65",
"/爱心": "66",
"/心碎": "67",
"/蛋糕": "68",
"/闪电": "69",
"/炸弹": "70",
"/刀": "71",
"/足球": "72",
"/瓢虫": "73",
"/便便": "74",
"/月亮": "75",
"/太阳": "76",
"/礼物": "77",
"/拥抱": "78",
"/强": "79",
"/弱": "80",
"/握手": "81",
"/胜利": "82",
"/抱拳": "83",
"/勾引": "84",
"/拳头": "85",
"/差劲": "86",
"/爱你": "87",
"/NO": "88",
"/OK": "89",
"/爱情": "90",
"/飞吻": "91",
"/跳跳": "92",
"/发抖": "93",
"/怄火": "94",
"/转圈": "95",
"/磕头": "96",
"/回头": "97",
"/跳绳": "98",
"/挥手": "99",
"/激动": "100",
"/街舞": "101",
"/献吻": "102",
"/左太极": "103",
"/右太极": "104",
"/::)": "0",
"/::~": "1",
"/::B": "2",
"/::|": "3",
"/:8-)": "4",
"/::<": "5",
"/::$": "6",
"/::X": "7",
"/::Z": "8",
"/::(": "9",
"/::'(": "9",
"/::-|": "10",
"/::@": "11",
"/::P": "12",
"/::D": "13",
"/::O": "14",
"/::(": "15",
"/::+": "16",
"/:--b": "17",
"/::Q": "18",
"/::T": "19",
"/:,@P": "20",
"/:,@-D": "21",
"/::d": "22",
"/:,@o": "23",
"/::g": "24",
"/:|-)": "25",
"/::!": "26",
"/::L": "27",
"/::>": "28",
"/::,@": "29",
"/:,@f": "30",
"/::-S": "31",
"/:?": "32",
"/:,@x": "33",
"/:,@@": "34",
"/::8": "35",
"/:,@!": "36",
"/:!!!": "37",
"/:xx": "38",
"/:bye": "39",
"/:wipe": "40",
"/:dig": "41",
"/:handclap": "42",
"/:&-(": "43",
"/:B-)": "44",
"/:<@": "45",
"/:@>": "46",
"/::-O": "47",
"/:>-|": "48",
"/:P-(": "49",
"/::'|": "50",
"/:X-)": "51",
"/::*": "52",
"/:@x": "53",
"/:8*": "54",
"/:pd": "55",
"/:<W>": "56",
"/:beer": "57",
"/:basketb": "58",
"/:oo": "59",
"/:coffee": "60",
"/:eat": "61",
"/:pig": "62",
"/:rose": "63",
"/:fade": "64",
"/:showlove": "65",
"/:heart": "66",
"/:break": "67",
"/:cake": "68",
"/:li": "69",
"/:bome": "70",
"/:kn": "71",
"/:footb": "72",
"/:ladybug": "73",
"/:shit": "74",
"/:moon": "75",
"/:sun": "76",
"/:gift": "77",
"/:hug": "78",
"/:strong": "79",
"/:weak": "80",
"/:share": "81",
"/:v": "82",
"/:@)": "83",
"/:jj": "84",
"/:@@": "85",
"/:bad": "86",
"/:lvu": "87",
"/:no": "88",
"/:ok": "89",
"/:love": "90",
"/:<L>": "91",
"/:jump": "92",
"/:shake": "93",
"/:<O>": "94",
"/:circle": "95",
"/:kotow": "96",
"/:turn": "97",
"/:skip": "98",
"/:oY": "99",
"/:#-0": "100",
"/:hiphot": "101",
"/:kiss": "102",
"/:<&": "103",
"/:&>": "104"
}, o = '<span class="emoji emoji%s"></span>', u = wx.resPath + "/mpres/htmledition/images/icon/emotion/", a = '<img src="' + u + '%s.gif" width="24" height="24">';
String.prototype.emoji = function() {
var e = this.toString();
for (var t in i) while (-1 != e.indexOf(t)) e = e.replace(t, o.sprintf(i[t]));
for (var t in s) while (-1 != e.indexOf(t)) e = e.replace(t, a.sprintf(s[t]));
return e;
};
} catch (f) {
wx.jslog({
src: "common/qq/emoji.js"
}, f);
}
});// moment.js
define("biz_common/moment.js", [], function(e, t, n) {
try {
var r = +(new Date), i, s = "2.0.0", o = Math.round, u, a = {}, f = typeof n != "undefined" && n.exports, l = /^\/?Date\((\-?\d+)/i, c = /(\[[^\[]*\])|(\\)?(Mo|MM?M?M?|Do|DDDo|DD?D?D?|ddd?d?|do?|w[o|w]?|W[o|W]?|YYYYY|YYYY|YY|a|A|hh?|HH?|mm?|ss?|SS?S?|X|zz?|ZZ?|.)/g, h = /(\[[^\[]*\])|(\\)?(LT|LL?L?L?|l{1,4})/g, p = /([0-9a-zA-Z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)/gi, d = /\d\d?/, v = /\d{1,3}/, m = /\d{3}/, g = /\d{1,4}/, y = /[+\-]?\d{1,6}/, b = /[0-9]*[a-z\u00A0-\u05FF\u0700-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+|[\u0600-\u06FF]+\s*?[\u0600-\u06FF]+/i, w = /Z|[\+\-]\d\d:?\d\d/i, E = /T/i, S = /[\+\-]?\d+(\.\d{1,3})?/, x = /^\s*\d{4}-\d\d-\d\d((T| )(\d\d(:\d\d(:\d\d(\.\d\d?\d?)?)?)?)?([\+\-]\d\d:?\d\d)?)?/, T = "YYYY-MM-DDTHH:mm:ssZ", N = [ [ "HH:mm:ss.S", /(T| )\d\d:\d\d:\d\d\.\d{1,3}/ ], [ "HH:mm:ss", /(T| )\d\d:\d\d:\d\d/ ], [ "HH:mm", /(T| )\d\d:\d\d/ ], [ "HH", /(T| )\d\d/ ] ], C = /([\+\-]|\d\d)/gi, k = "Month|Date|Hours|Minutes|Seconds|Milliseconds".split("|"), L = {
Milliseconds: 1,
Seconds: 1e3,
Minutes: 6e4,
Hours: 36e5,
Days: 864e5,
Months: 2592e6,
Years: 31536e6
}, A = {}, O = "DDD w W M D d".split(" "), M = "M D H h m s w W".split(" "), _ = {
M: function() {
return this.month() + 1;
},
MMM: function(e) {
return this.lang().monthsShort(this, e);
},
MMMM: function(e) {
return this.lang().months(this, e);
},
D: function() {
return this.date();
},
DDD: function() {
return this.dayOfYear();
},
d: function() {
return this.day();
},
dd: function(e) {
return this.lang().weekdaysMin(this, e);
},
ddd: function(e) {
return this.lang().weekdaysShort(this, e);
},
dddd: function(e) {
return this.lang().weekdays(this, e);
},
w: function() {
return this.week();
},
W: function() {
return this.isoWeek();
},
YY: function() {
return q(this.year() % 100, 2);
},
YYYY: function() {
return q(this.year(), 4);
},
YYYYY: function() {
return q(this.year(), 5);
},
a: function() {
return this.lang().meridiem(this.hours(), this.minutes(), !0);
},
A: function() {
return this.lang().meridiem(this.hours(), this.minutes(), !1);
},
H: function() {
return this.hours();
},
h: function() {
return this.hours() % 12 || 12;
},
m: function() {
return this.minutes();
},
s: function() {
return this.seconds();
},
S: function() {
return ~~(this.milliseconds() / 100);
},
SS: function() {
return q(~~(this.milliseconds() / 10), 2);
},
SSS: function() {
return q(this.milliseconds(), 3);
},
Z: function() {
var e = -this.zone(), t = "+";
return e < 0 && (e = -e, t = "-"), t + q(~~(e / 60), 2) + ":" + q(~~e % 60, 2);
},
ZZ: function() {
var e = -this.zone(), t = "+";
return e < 0 && (e = -e, t = "-"), t + q(~~(10 * e / 6), 4);
},
X: function() {
return this.unix();
}
};
function D(e, t) {
return function(n) {
return q(e.call(this, n), t);
};
}
function P(e) {
return function(t) {
return this.lang().ordinal(e.call(this, t));
};
}
while (O.length) u = O.pop(), _[u + "o"] = P(_[u]);
while (M.length) u = M.pop(), _[u + u] = D(_[u], 2);
_.DDDD = D(_.DDD, 3);
function H() {}
function B(e) {
F(this, e);
}
function j(e) {
var t = this._data = {}, n = e.years || e.year || e.y || 0, r = e.months || e.month || e.M || 0, i = e.weeks || e.week || e.w || 0, s = e.days || e.day || e.d || 0, o = e.hours || e.hour || e.h || 0, u = e.minutes || e.minute || e.m || 0, a = e.seconds || e.second || e.s || 0, f = e.milliseconds || e.millisecond || e.ms || 0;
this._milliseconds = f + a * 1e3 + u * 6e4 + o * 36e5, this._days = s + i * 7, this._months = r + n * 12, t.milliseconds = f % 1e3, a += I(f / 1e3), t.seconds = a % 60, u += I(a / 60), t.minutes = u % 60, o += I(u / 60), t.hours = o % 24, s += I(o / 24), s += i * 7, t.days = s % 30, r += I(s / 30), t.months = r % 12, n += I(r / 12), t.years = n;
}
function F(e, t) {
for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n]);
return e;
}
function I(e) {
return e < 0 ? Math.ceil(e) : Math.floor(e);
}
function q(e, t) {
var n = e + "";
while (n.length < t) n = "0" + n;
return n;
}
function R(e, t, n) {
var r = t._milliseconds, i = t._days, s = t._months, o;
r && e._d.setTime(+e + r * n), i && e.date(e.date() + i * n), s && (o = e.date(), e.date(1).month(e.month() + s * n).date(Math.min(o, e.daysInMonth())));
}
function U(e) {
return Object.prototype.toString.call(e) === "[object Array]";
}
function z(e, t) {
var n = Math.min(e.length, t.length), r = Math.abs(e.length - t.length), i = 0, s;
for (s = 0; s < n; s++) ~~e[s] !== ~~t[s] && i++;
return i + r;
}
H.prototype = {
set: function(e) {
var t, n;
for (n in e) t = e[n], typeof t == "function" ? this[n] = t : this["_" + n] = t;
},
_months: "January_February_March_April_May_June_July_August_September_October_November_December".split("_"),
months: function(e) {
return this._months[e.month()];
},
_monthsShort: "Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"),
monthsShort: function(e) {
return this._monthsShort[e.month()];
},
monthsParse: function(e) {
var t, n, r, s;
this._monthsParse || (this._monthsParse = []);
for (t = 0; t < 12; t++) {
this._monthsParse[t] || (n = i([ 2e3, t ]), r = "^" + this.months(n, "") + "|^" + this.monthsShort(n, ""), this._monthsParse[t] = new RegExp(r.replace(".", ""), "i"));
if (this._monthsParse[t].test(e)) return t;
}
},
_weekdays: "Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),
weekdays: function(e) {
return this._weekdays[e.day()];
},
_weekdaysShort: "Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"),
weekdaysShort: function(e) {
return this._weekdaysShort[e.day()];
},
_weekdaysMin: "Su_Mo_Tu_We_Th_Fr_Sa".split("_"),
weekdaysMin: function(e) {
return this._weekdaysMin[e.day()];
},
_longDateFormat: {
LT: "h:mm A",
L: "MM/DD/YYYY",
LL: "MMMM D YYYY",
LLL: "MMMM D YYYY LT",
LLLL: "dddd, MMMM D YYYY LT"
},
longDateFormat: function(e) {
var t = this._longDateFormat[e];
return !t && this._longDateFormat[e.toUpperCase()] && (t = this._longDateFormat[e.toUpperCase()].replace(/MMMM|MM|DD|dddd/g, function(e) {
return e.slice(1);
}), this._longDateFormat[e] = t), t;
},
meridiem: function(e, t, n) {
return e > 11 ? n ? "pm" : "PM" : n ? "am" : "AM";
},
_calendar: {
sameDay: "[Today at] LT",
nextDay: "[Tomorrow at] LT",
nextWeek: "dddd [at] LT",
lastDay: "[Yesterday at] LT",
lastWeek: "[last] dddd [at] LT",
sameElse: "L"
},
calendar: function(e, t) {
var n = this._calendar[e];
return typeof n == "function" ? n.apply(t) : n;
},
_relativeTime: {
future: "in %s",
past: "%s ago",
s: "a few seconds",
m: "a minute",
mm: "%d minutes",
h: "an hour",
hh: "%d hours",
d: "a day",
dd: "%d days",
M: "a month",
MM: "%d months",
y: "a year",
yy: "%d years"
},
relativeTime: function(e, t, n, r) {
var i = this._relativeTime[n];
return typeof i == "function" ? i(e, t, n, r) : i.replace(/%d/i, e);
},
pastFuture: function(e, t) {
var n = this._relativeTime[e > 0 ? "future" : "past"];
return typeof n == "function" ? n(t) : n.replace(/%s/i, t);
},
ordinal: function(e) {
return this._ordinal.replace("%d", e);
},
_ordinal: "%d",
preparse: function(e) {
return e;
},
postformat: function(e) {
return e;
},
week: function(e) {
return it(e, this._week.dow, this._week.doy);
},
_week: {
dow: 0,
doy: 6
}
};
function W(e, t) {
return t.abbr = e, a[e] || (a[e] = new H), a[e].set(t), a[e];
}
function X(t) {
return t ? (!a[t] && f && e("./lang/" + t), a[t]) : i.fn._lang;
}
function V(e) {
return e.match(/\[.*\]/) ? e.replace(/^\[|\]$/g, "") : e.replace(/\\/g, "");
}
function $(e) {
var t = e.match(c), n, r;
for (n = 0, r = t.length; n < r; n++) _[t[n]] ? t[n] = _[t[n]] : t[n] = V(t[n]);
return function(i) {
var s = "";
for (n = 0; n < r; n++) s += typeof t[n].call == "function" ? t[n].call(i, e) : t[n];
return s;
};
}
function J(e, t) {
function n(t) {
return e.lang().longDateFormat(t) || t;
}
var r = 5;
while (r-- && h.test(t)) t = t.replace(h, n);
return A[t] || (A[t] = $(t)), A[t](e);
}
function K(e) {
switch (e) {
case "DDDD":
return m;
case "YYYY":
return g;
case "YYYYY":
return y;
case "S":
case "SS":
case "SSS":
case "DDD":
return v;
case "MMM":
case "MMMM":
case "dd":
case "ddd":
case "dddd":
case "a":
case "A":
return b;
case "X":
return S;
case "Z":
case "ZZ":
return w;
case "T":
return E;
case "MM":
case "DD":
case "YY":
case "HH":
case "hh":
case "mm":
case "ss":
case "M":
case "D":
case "d":
case "H":
case "h":
case "m":
case "s":
return d;
default:
return new RegExp(e.replace("\\", ""));
}
}
function Q(e, t, n) {
var r, i, s = n._a;
switch (e) {
case "M":
case "MM":
s[1] = t == null ? 0 : ~~t - 1;
break;
case "MMM":
case "MMMM":
r = X(n._l).monthsParse(t), r != null ? s[1] = r : n._isValid = !1;
break;
case "D":
case "DD":
case "DDD":
case "DDDD":
t != null && (s[2] = ~~t);
break;
case "YY":
s[0] = ~~t + (~~t > 68 ? 1900 : 2e3);
break;
case "YYYY":
case "YYYYY":
s[0] = ~~t;
break;
case "a":
case "A":
n._isPm = (t + "").toLowerCase() === "pm";
break;
case "H":
case "HH":
case "h":
case "hh":
s[3] = ~~t;
break;
case "m":
case "mm":
s[4] = ~~t;
break;
case "s":
case "ss":
s[5] = ~~t;
break;
case "S":
case "SS":
case "SSS":
s[6] = ~~(("0." + t) * 1e3);
break;
case "X":
n._d = new Date(parseFloat(t) * 1e3);
break;
case "Z":
case "ZZ":
n._useUTC = !0, r = (t + "").match(C), r && r[1] && (n._tzh = ~~r[1]), r && r[2] && (n._tzm = ~~r[2]), r && r[0] === "+" && (n._tzh = -n._tzh, n._tzm = -n._tzm);
}
t == null && (n._isValid = !1);
}
function G(e) {
var t, n, r = [];
if (e._d) return;
for (t = 0; t < 7; t++) e._a[t] = r[t] = e._a[t] == null ? t === 2 ? 1 : 0 : e._a[t];
r[3] += e._tzh || 0, r[4] += e._tzm || 0, n = new Date(0), e._useUTC ? (n.setUTCFullYear(r[0], r[1], r[2]), n.setUTCHours(r[3], r[4], r[5], r[6])) : (n.setFullYear(r[0], r[1], r[2]), n.setHours(r[3], r[4], r[5], r[6])), e._d = n;
}
function Y(e) {
var t = e._f.match(c), n = e._i, r, i;
e._a = [];
for (r = 0; r < t.length; r++) i = (K(t[r]).exec(n) || [])[0], i && (n = n.slice(n.indexOf(i) + i.length)), _[t[r]] && Q(t[r], i, e);
e._isPm && e._a[3] < 12 && (e._a[3] += 12), e._isPm === !1 && e._a[3] === 12 && (e._a[3] = 0), G(e);
}
function Z(e) {
var t, n, r, i = 99, s, o, u;
while (e._f.length) {
t = F({}, e), t._f = e._f.pop(), Y(t), n = new B(t);
if (n.isValid()) {
r = n;
break;
}
u = z(t._a, n.toArray()), u < i && (i = u, r = n);
}
F(e, r);
}
function et(e) {
var t, n = e._i;
if (x.exec(n)) {
e._f = "YYYY-MM-DDT";
for (t = 0; t < 4; t++) if (N[t][1].exec(n)) {
e._f += N[t][0];
break;
}
w.exec(n) && (e._f += " Z"), Y(e);
} else e._d = new Date(n);
}
function tt(e) {
var t = e._i, n = l.exec(t);
t === undefined ? e._d = new Date : n ? e._d = new Date(+n[1]) : typeof t == "string" ? et(e) : U(t) ? (e._a = t.slice(0), G(e)) : e._d = t instanceof Date ? new Date(+t) : new Date(t);
}
function nt(e, t, n, r, i) {
return i.relativeTime(t || 1, !!n, e, r);
}
function rt(e, t, n) {
var r = o(Math.abs(e) / 1e3), i = o(r / 60), s = o(i / 60), u = o(s / 24), a = o(u / 365), f = r < 45 && [ "s", r ] || i === 1 && [ "m" ] || i < 45 && [ "mm", i ] || s === 1 && [ "h" ] || s < 22 && [ "hh", s ] || u === 1 && [ "d" ] || u <= 25 && [ "dd", u ] || u <= 45 && [ "M" ] || u < 345 && [ "MM", o(u / 30) ] || a === 1 && [ "y" ] || [ "yy", a ];
return f[2] = t, f[3] = e > 0, f[4] = n, nt.apply({}, f);
}
function it(e, t, n) {
var r = n - t, s = n - e.day();
return s > r && (s -= 7), s < r - 7 && (s += 7), Math.ceil(i(e).add("d", s).dayOfYear() / 7);
}
function st(e) {
var t = e._i, n = e._f;
return t === null || t === "" ? null : (typeof t == "string" && (e._i = t = X().preparse(t)), i.isMoment(t) ? (e = F({}, t), e._d = new Date(+t._d)) : n ? U(n) ? Z(e) : Y(e) : tt(e), new B(e));
}
i = function(e, t, n) {
return st({
_i: e,
_f: t,
_l: n,
_isUTC: !1
});
}, i.utc = function(e, t, n) {
return st({
_useUTC: !0,
_isUTC: !0,
_l: n,
_i: e,
_f: t
});
}, i.unix = function(e) {
return i(e * 1e3);
}, i.duration = function(e, t) {
var n = i.isDuration(e), r = typeof e == "number", s = n ? e._data : r ? {} : e, o;
return r && (t ? s[t] = e : s.milliseconds = e), o = new j(s), n && e.hasOwnProperty("_lang") && (o._lang = e._lang), o;
}, i.version = s, i.defaultFormat = T, i.lang = function(e, t) {
var n;
if (!e) return i.fn._lang._abbr;
t ? W(e, t) : a[e] || X(e), i.duration.fn._lang = i.fn._lang = X(e);
}, i.langData = function(e) {
return e && e._lang && e._lang._abbr && (e = e._lang._abbr), X(e);
}, i.isMoment = function(e) {
return e instanceof B;
}, i.isDuration = function(e) {
return e instanceof j;
}, i.fn = B.prototype = {
clone: function() {
return i(this);
},
valueOf: function() {
return +this._d;
},
unix: function() {
return Math.floor(+this._d / 1e3);
},
toString: function() {
return this.format("ddd MMM DD YYYY HH:mm:ss [GMT]ZZ");
},
toDate: function() {
return this._d;
},
toJSON: function() {
return i.utc(this).format("YYYY-MM-DD[T]HH:mm:ss.SSS[Z]");
},
toArray: function() {
var e = this;
return [ e.year(), e.month(), e.date(), e.hours(), e.minutes(), e.seconds(), e.milliseconds() ];
},
isValid: function() {
return this._isValid == null && (this._a ? this._isValid = !z(this._a, (this._isUTC ? i.utc(this._a) : i(this._a)).toArray()) : this._isValid = !isNaN(this._d.getTime())), !!this._isValid;
},
utc: function() {
return this._isUTC = !0, this;
},
local: function() {
return this._isUTC = !1, this;
},
format: function(e) {
var t = J(this, e || i.defaultFormat);
return this.lang().postformat(t);
},
add: function(e, t) {
var n;
return typeof e == "string" ? n = i.duration(+t, e) : n = i.duration(e, t), R(this, n, 1), this;
},
subtract: function(e, t) {
var n;
return typeof e == "string" ? n = i.duration(+t, e) : n = i.duration(e, t), R(this, n, -1), this;
},
diff: function(e, t, n) {
var r = this._isUTC ? i(e).utc() : i(e).local(), s = (this.zone() - r.zone()) * 6e4, o, u;
return t && (t = t.replace(/s$/, "")), t === "year" || t === "month" ? (o = (this.daysInMonth() + r.daysInMonth()) * 432e5, u = (this.year() - r.year()) * 12 + (this.month() - r.month()), u += (this - i(this).startOf("month") - (r - i(r).startOf("month"))) / o, t === "year" && (u /= 12)) : (o = this - r - s, u = t === "second" ? o / 1e3 : t === "minute" ? o / 6e4 : t === "hour" ? o / 36e5 : t === "day" ? o / 864e5 : t === "week" ? o / 6048e5 : o), n ? u : I(u);
},
from: function(e, t) {
return i.duration(this.diff(e)).lang(this.lang()._abbr).humanize(!t);
},
fromNow: function(e) {
return this.from(i(), e);
},
calendar: function() {
var e = this.diff(i().startOf("day"), "days", !0), t = e < -6 ? "sameElse" : e < -1 ? "lastWeek" : e < 0 ? "lastDay" : e < 1 ? "sameDay" : e < 2 ? "nextDay" : e < 7 ? "nextWeek" : "sameElse";
return this.format(this.lang().calendar(t, this));
},
isLeapYear: function() {
var e = this.year();
return e % 4 === 0 && e % 100 !== 0 || e % 400 === 0;
},
isDST: function() {
return this.zone() < i([ this.year() ]).zone() || this.zone() < i([ this.year(), 5 ]).zone();
},
day: function(e) {
var t = this._isUTC ? this._d.getUTCDay() : this._d.getDay();
return e == null ? t : this.add({
d: e - t
});
},
startOf: function(e) {
e = e.replace(/s$/, "");
switch (e) {
case "year":
this.month(0);
case "month":
this.date(1);
case "week":
case "day":
this.hours(0);
case "hour":
this.minutes(0);
case "minute":
this.seconds(0);
case "second":
this.milliseconds(0);
}
return e === "week" && this.day(0), this;
},
endOf: function(e) {
return this.startOf(e).add(e.replace(/s?$/, "s"), 1).subtract("ms", 1);
},
isAfter: function(e, t) {
return t = typeof t != "undefined" ? t : "millisecond", +this.clone().startOf(t) > +i(e).startOf(t);
},
isBefore: function(e, t) {
return t = typeof t != "undefined" ? t : "millisecond", +this.clone().startOf(t) < +i(e).startOf(t);
},
isSame: function(e, t) {
return t = typeof t != "undefined" ? t : "millisecond", +this.clone().startOf(t) === +i(e).startOf(t);
},
zone: function() {
return this._isUTC ? 0 : this._d.getTimezoneOffset();
},
daysInMonth: function() {
return i.utc([ this.year(), this.month() + 1, 0 ]).date();
},
dayOfYear: function(e) {
var t = o((i(this).startOf("day") - i(this).startOf("year")) / 864e5) + 1;
return e == null ? t : this.add("d", e - t);
},
isoWeek: function(e) {
var t = it(this, 1, 4);
return e == null ? t : this.add("d", (e - t) * 7);
},
week: function(e) {
var t = this.lang().week(this);
return e == null ? t : this.add("d", (e - t) * 7);
},
lang: function(e) {
return e === undefined ? this._lang : (this._lang = X(e), this);
}
};
function ot(e, t) {
i.fn[e] = i.fn[e + "s"] = function(e) {
var n = this._isUTC ? "UTC" : "";
return e != null ? (this._d["set" + n + t](e), this) : this._d["get" + n + t]();
};
}
for (u = 0; u < k.length; u++) ot(k[u].toLowerCase().replace(/s$/, ""), k[u]);
ot("year", "FullYear"), i.fn.days = i.fn.day, i.fn.weeks = i.fn.week, i.fn.isoWeeks = i.fn.isoWeek, i.duration.fn = j.prototype = {
weeks: function() {
return I(this.days() / 7);
},
valueOf: function() {
return this._milliseconds + this._days * 864e5 + this._months * 2592e6;
},
humanize: function(e) {
var t = +this, n = rt(t, !e, this.lang());
return e && (n = this.lang().pastFuture(t, n)), this.lang().postformat(n);
},
lang: i.fn.lang
};
function ut(e) {
i.duration.fn[e] = function() {
return this._data[e];
};
}
function at(e, t) {
i.duration.fn["as" + e] = function() {
return +this / t;
};
}
for (u in L) L.hasOwnProperty(u) && (at(u, L[u]), ut(u.toLowerCase()));
return at("Weeks", 6048e5), i.lang("zh-cn", {
months: "一月_二月_三月_四月_五月_六月_七月_八月_九月_十月_十一月_十二月".split("_"),
monthsShort: "1月_2月_3月_4月_5月_6月_7月_8月_9月_10月_11月_12月".split("_"),
weekdays: "星期日_星期一_星期二_星期三_星期四_星期五_星期六".split("_"),
weekdaysShort: "周日_周一_周二_周三_周四_周五_周六".split("_"),
weekdaysMin: "日_一_二_三_四_五_六".split("_"),
longDateFormat: {
LT: "Ah点mm",
L: "YYYY年MMMD日",
LL: "YYYY年MMMD日",
LLL: "YYYY年MMMD日LT",
LLLL: "YYYY年MMMD日ddddLT",
l: "YYYY年MMMD日",
ll: "YYYY年MMMD日",
lll: "YYYY年MMMD日LT",
llll: "YYYY年MMMD日ddddLT"
},
meridiem: function(e, t, n) {
return e < 9 ? "早上" : e < 11 && t < 30 ? "上午" : e < 13 && t < 30 ? "中午" : e < 18 ? "下午" : "晚上";
},
calendar: {
sameDay: "[今天]LT",
nextDay: "[明天]LT",
nextWeek: "[下]ddddLT",
lastDay: "[昨天]LT",
lastWeek: "[上]ddddLT",
sameElse: "L"
},
ordinal: function(e, t) {
switch (t) {
case "d":
case "D":
case "DDD":
return e + "日";
case "M":
return e + "月";
case "w":
case "W":
return e + "周";
default:
return e;
}
},
relativeTime: {
future: "%s内",
past: "%s前",
s: "几秒",
m: "1分钟",
mm: "%d分钟",
h: "1小时",
hh: "%d小时",
d: "1天",
dd: "%d天",
M: "1个月",
MM: "%d个月",
y: "1年",
yy: "%d年"
}
}), i;
} catch (ft) {
wx.jslog({
src: "biz_common/moment.js"
}, ft);
}
});//https://github.com/leizongmin/js-xss
define("biz_common/xss.js", [], function(e, t, n) {
try {
var r = +(new Date), i = {
h1: [],
h2: [],
h3: [],
h4: [],
h5: [],
h6: [],
hr: [],
span: [],
strong: [],
b: [],
i: [],
br: [],
p: [],
pre: [],
code: [],
a: [ "target", "href", "title" ],
img: [ "src", "alt", "title" ],
div: [],
table: [ "width", "border" ],
tr: [],
td: [ "width", "colspan" ],
th: [ "width", "colspan" ],
tbody: [],
ul: [],
li: [],
ol: [],
dl: [],
dt: [],
em: [],
cite: [],
section: [],
header: [],
footer: [],
blockquote: [],
audio: [ "autoplay", "controls", "loop", "preload", "src" ],
video: [ "autoplay", "controls", "loop", "preload", "src", "height", "width" ]
}, s = /</g, o = />/g, u = /"/g, a = /[^a-zA-Z0-9_:\.\-]/img, f = /&#([a-zA-Z0-9]*);?/img, l = /\/\*|\*\//mg, c = /^[\s"'`]*((j\s*a\s*v\s*a|v\s*b|l\s*i\s*v\s*e)\s*s\s*c\s*r\s*i\s*p\s*t\s*|m\s*o\s*c\s*h\s*a):/ig, h = /\/\*|\*\//mg, p = /((j\s*a\s*v\s*a|v\s*b|l\s*i\s*v\s*e)\s*s\s*c\s*r\s*i\s*p\s*t\s*|m\s*o\s*c\s*h\s*a):/ig;
function d(e, t, n) {
if (t === "href" || t === "src") {
l.lastIndex = 0;
if (l.test(n)) return "#";
c.lastIndex = 0;
if (c.test(n)) return "#";
} else if (t === "style") {
h.lastIndex = 0;
if (h.test(n)) return "#";
p.lastIndex = 0;
if (p.test(n)) return "";
}
}
function v(e, t, n) {
return m(t);
}
function m(e) {
return e.replace(s, "&lt;").replace(o, "&gt;");
}
function g(e, t) {
return String.fromCharCode(parseInt(t));
}
function y(e) {
"use strict";
this.options = e = e || {}, this.whiteList = e.whiteList || t.whiteList, this.onTagAttr = e.onTagAttr || t.onTagAttr, this.onIgnoreTag = e.onIgnoreTag || t.onIgnoreTag;
}
y.prototype.filterAttributes = function(e, t) {
"use strict";
e = e.toLowerCase();
var n = this, r = this.whiteList[e], i = 0, s = "", o = !1, l = !1, c = function(t, i) {
t = t.trim();
if (!l && t === "/") {
l = !0;
return;
}
t = t.replace(a, "").toLowerCase();
if (t.length < 1) return;
if (r.indexOf(t) !== -1) {
if (i) {
i = i.trim().replace(u, "&quote;"), i = i.replace(f, g);
var o = "";
for (var c = 0, h = i.length; c < h; c++) o += i.charCodeAt(c) < 32 ? " " : i.charAt(c);
i = o.trim();
var p = n.onTagAttr(e, t, i);
typeof p != "undefined" && (i = p);
}
s += t + (i ? '="' + i + '"' : "") + " ";
}
};
for (var h = 0, p = t.length; h < p; h++) {
var d = t.charAt(h);
if (o === !1 && d === "=") {
o = t.slice(i, h), i = h + 1;
continue;
}
if (o !== !1 && h === i && (d === '"' || d === "'")) {
var v = t.indexOf(d, h + 1);
if (v === -1) break;
var m = t.slice(i + 1, v).trim();
c(o, m), o = !1, h = v, i = h + 1;
continue;
}
if (d === " ") {
var m = t.slice(i, h).trim();
o === !1 ? c(m) : c(o, m), o = !1, i = h + 1;
continue;
}
}
return i < t.length && (o === !1 ? c(t.slice(i)) : c(o, t.slice(i))), l && (s += "/"), s.trim();
}, y.prototype.addNewTag = function(e, t, n) {
"use strict";
var r = "", i = e.slice(0, 2) === "</" ? 2 : 1, s = e.indexOf(" ");
if (s === -1) var o = e.slice(i, e.length - 1).trim(); else var o = e.slice(i, s + 1).trim();
o = o.toLowerCase();
if (o in this.whiteList) if (s === -1) r += e.slice(0, i) + o + ">"; else {
var u = this.filterAttributes(o, e.slice(s + 1, e.length - 1).trim());
r += e.slice(0, i) + o + (u.length > 0 ? " " + u : "") + ">";
} else {
var a = {
isClosing: i === 2,
position: n,
originalPosition: t - e.length + 1
}, f = this.onIgnoreTag(o, e, a);
typeof f == "undefined" && (f = m(e)), r += f;
}
return r;
}, y.prototype.process = function(e) {
"use strict";
var t = "", n = 0, r = !1, i = !1, s = 0;
for (var s = 0, o = e.length; s < o; s++) {
var u = e.charAt(s);
if (r === !1) {
if (u === "<") {
r = s;
continue;
}
} else if (i === !1) {
if (u === "<") {
t += m(e.slice(n, s)), r = s, n = s;
continue;
}
if (u === ">") {
t += m(e.slice(n, r)), t += this.addNewTag(e.slice(r, s + 1), s, t.length), n = s + 1, r = !1;
continue;
}
if (u === '"' || u === "'") {
i = u;
continue;
}
} else if (u === i) {
i = !1;
continue;
}
}
return n < e.length && (t += m(e.substr(n))), t;
};
function b(e, t) {
var n = new y(t);
return n.process(e);
}
t = n.exports = b, t.FilterXSS = y, t.whiteList = i, t.onTagAttr = d, t.onIgnoreTag = v, t.utils = {
tagFilter: function(e, t) {
typeof t != "function" && (t = function() {});
var n = [], r = !1;
return {
onIgnoreTag: function(i, s, o) {
if (e.indexOf(i) !== -1) {
var u = "[removed]";
if (r !== !1 && o.isClosing) {
var a = o.position + u.length;
n.push([ r, a ]), r = !1;
} else r = o.position;
return u;
}
return t(i, s, o);
},
filter: function(e) {
var t = "", r = 0;
return n.forEach(function(n) {
t += e.slice(r, n[0]), r = n[1];
}), t += e.slice(r), t;
}
};
}
};
} catch (w) {
wx.jslog({
src: "biz_common/xss.js"
}, w);
}
});define("common/qq/mask.js", [ "biz_web/lib/spin.js" ], function(e, t, n) {
try {
var r = +(new Date);
"use strict", e("biz_web/lib/spin.js");
var i = 0, s = '<div class="mask"></div>';
function o(e) {
if (this.mask) this.mask.show(); else {
var t = "body";
e && !!e.parent && (t = $(e.parent)), this.mask = $(s).appendTo(t), this.mask.id = "wxMask_" + ++i, this.mask.spin("flower");
}
if (e) {
if (e.spin === !1) return this;
this.mask.spin(e.spin || "flower");
}
return this;
}
o.prototype = {
show: function() {
this.mask.show();
},
hide: function() {
this.mask.hide();
},
remove: function() {
this.mask.remove();
}
}, t.show = function(e) {
return new o(e);
}, t.hide = function() {
$(".mask").hide();
}, t.remove = function() {
$(".mask").remove();
};
} catch (u) {
wx.jslog({
src: "common/qq/mask.js"
}, u);
}
});define("common/wx/media/factory.js", [ "common/wx/media/img.js", "common/wx/media/audio.js", "common/wx/media/video.js", "common/wx/media/appmsg.js", "common/qq/emoji.js" ], function(e, t, n) {
try {
var r = +(new Date);
"use strict";
var i = e("common/wx/media/img.js"), s = e("common/wx/media/audio.js"), o = e("common/wx/media/video.js"), u = e("common/wx/media/appmsg.js");
e("common/qq/emoji.js");
var a = {
"1": function(e, t) {
return $(e).html(t.content.emoji());
},
"2": function(e, t) {
return t.container = $(e), new i(t);
},
"3": function(e, t) {
return t.selector = $(e), t.source = "file", new s(t);
},
"4": function(e, t) {
return t.selector = $(e), t.id = t.file_id, t.source = "file", new o(t);
},
"10": function(e, t) {
return t.container = $(e), t.showMask = !1, new u(t);
},
"11": function(e, t) {
return t.container = $(e), t.showMask = !1, new u(t);
},
"15": function(e, t) {
return t.multi_item && t.multi_item[0] && (t.title = t.multi_item[0].title, t.digest = t.multi_item[0].digest), t.selector = $(e), t.id = Math.random() * 1e6 | 0, t.tpl = "videomsg", t.for_selection = !1, t.for_operation = !1, new o(t);
}
}, f = {
render: function(e, t) {
a[t.type] && $(e).length > 0 && a[t.type]($(e).html(""), t);
},
itemRender: a
};
n.exports = f;
} catch (l) {
wx.jslog({
src: "common/wx/media/factory.js"
}, l);
}
});define("common/wx/richEditor/msgSender.js", [ "common/wx/popup.js", "widget/msg_sender.css", "common/qq/jquery.plugin/tab.js", "common/wx/richEditor/emotionEditor.js", "media/media_dialog.js", "common/wx/media/factory.js", "common/qq/Class.js", "common/wx/Tips.js", "common/wx/media/audio.js", "common/wx/media/img.js", "common/wx/media/video.js", "common/wx/tooltip.js", "common/wx/media/appmsg.js" ], function(e, t, n) {
try {
var r = +(new Date);
"use strict", e("common/wx/popup.js"), e("widget/msg_sender.css");
var i = e("common/qq/jquery.plugin/tab.js"), s = e("common/wx/richEditor/emotionEditor.js"), o = e("media/media_dialog.js"), u = e("common/wx/media/factory.js"), a = e("common/qq/Class.js"), f = e("common/wx/Tips.js"), l = e("common/wx/media/audio.js"), c = e("common/wx/media/img.js"), h = e("common/wx/media/video.js"), p = e("common/wx/tooltip.js"), d = e("common/wx/media/appmsg.js"), v = 1, m = {}, g = [ {
text: "文字",
acl: "can_text_msg",
className: "tab_text",
selector: "js_textArea",
innerClassName: "no_extra",
type: 1
}, {
text: "图片",
acl: "can_image_msg",
className: "tab_img",
selector: "js_imgArea",
type: 2
}, {
text: "语音",
acl: "can_voice_msg",
className: "tab_audio",
selector: "js_audioArea",
type: 3
}, {
text: "视频",
acl: "can_video_msg",
className: "tab_video",
selector: "js_videoArea",
type: 15
}, {
text: "图文消息",
acl: "can_app_msg",
className: "tab_appmsg",
selector: "js_appmsgArea",
type: 10
}, {
text: "商品消息",
acl: "can_commodity_app_msg",
className: "tab_commondity_appmsg",
selector: "js_commondityAppmsgArea",
type: 11
} ];
function y(e, t) {
var n = [];
for (var r = 0; r < e.length; ++r) {
var i = e[r];
!!t && !!t[i.acl] && n.push(i);
}
return n;
}
function b(e) {
var t = {}, n = e.slice();
n.push({
acl: "can_video_msg",
className: "tab_video",
selector: "js_videoArea",
text: "视频",
type: 4,
index: 3
});
for (var r = 0; r < n.length; ++r) {
var i = n[r];
i.index = i.index || r, t[i.type] = i;
}
return t;
}
var w = u.itemRender, E = a.declare({
select: function() {
this.msgSender.type = this.type;
},
fillData: function(e) {},
getData: function() {},
click: function() {
this.msgSender.type = this.type;
}
}), S = E.Inherit({
init: function(e) {
this.msgSender = e, this.type = 1, this.info = e.infos[this.type], this.wordlimit = e.opt.wordlimit, this.index = this.info && this.info.index;
},
fillData: function(e) {
var t = this.msgSender;
t.type = this.type, t.select(this.index), t.emotionEditor.setContent(e.content);
},
getData: function() {
var e = this.msgSender.emotionEditor.getContent();
return {
type: this.type,
content: e
};
},
clear: function() {
return this.fillData({
content: ""
});
},
isValidate: function(e) {
var t = e && e.type == 1 && e.content != "" && e.content.length <= this.wordlimit;
return t || f.err("文字必须为1到%s个字".sprintf(this.wordlimit)), t;
}
}), x = E.Inherit({
init: function(e, t) {
this.type = t, this.msgSender = e, this.info = e.infos[t], this.index = this.info && this.info.index;
},
click: function() {
var e = null, t = this;
return t.type == 10 || t.type == 11 || t.type == 15 ? e = o.getAppmsg : e = o.getFile, e({
type: t.type,
begin: 0,
count: 10,
onSelect: function(e, n) {
var r = t.msgSender;
t.msgSender.type = e, r.select(t.index);
var i = "msgSender_media_%s_%s".sprintf(r.gid, e);
$("." + t.info.selector).html('<div id="%s"></div>'.sprintf(i)), w[e] && w[e]("#" + i, n);
}
}), !1;
},
fillData: function(e) {
var t = this.msgSender, n = this.type, r = "msgSender_media_%s_%s".sprintf(t.gid, n);
$("." + this.info.selector).html('<div id="%s"></div>'.sprintf(r)), t.select(this.index), this.msgSender.type = n, w[n] && w[n]("#" + r, e);
},
clear: function() {
var e = this.type;
return $("." + this.info.selector).html("");
},
getData: function(e) {
var t = this.type, n = "msgSender_media_%s_%s".sprintf(this.msgSender.gid, t), r = $("#" + n).data("opt");
if (!r) return !1;
if (!e) return t == 10 || t == 11 ? {
type: t,
app_id: r.data.app_id
} : t == 15 ? {
type: t,
app_id: r.app_id
} : {
type: t,
file_id: r.file_id
};
r.type = t;
var i = r.data || {};
return $.extend(r, i);
},
isValidate: function(e) {
var t = !!e;
if (!!e) {
var n = e.type;
n == 10 || n == 11 || n == 15 ? t = !!e.type && !!e.app_id : t = !!e.type && !!e.file_id;
}
return t || f.err("请选择素材"), t;
}
}), T = {
wordlimit: 600
}, N = a.declare({
init: function(e, t) {
var n = this, r = 0;
e = $(e).show(), n.gid = v++, n.opt = $.extend(!0, {}, T, t);
var i = g, s = t && t.acl || {};
i = y(i, s), n.infos = b(i), n.op = {
"1": new S(n),
"2": new x(n, 2),
"3": new x(n, 3),
"4": new x(n, 4),
"7": new x(n, 15),
"10": new x(n, 10),
"11": new x(n, 11),
"15": new x(n, 15)
}, n.tab = e.tab({
index: r,
tabs: i,
select: function(e, t, n, r) {},
click: function(e, t, r, i) {
return n.op[i] && n.op[i].click();
}
}), n._init(e);
var o = t.data;
o ? n.setData(o) : n.type = 1;
},
setData: function(e) {
e = e || {
type: 1
};
var t = this, n = null, r = e.type;
t.type = r || 1, !(n = t.op[r]) || n.fillData(e);
},
_init: function(e) {
this.dom = e, this.emotionEditor = new s($(".js_textArea", e), {
wordlimit: this.opt.wordlimit,
linebreak: !0
}), new p({
dom: this.dom.find(".tab_nav"),
position: {
x: -2,
y: 1
}
});
},
getData: function(e) {
if (this.type) {
var t = this.op[this.type].getData(e);
return {
error: !this.isValidate(),
data: t
};
}
return {
error: !0
};
},
getArea: function(e) {
return this.dom.find("." + this.infos[e].selector);
},
getTabs: function() {
return this.tab.getTabs();
},
isValidate: function() {
var e = this.type && this.op[this.type].getData();
return this.type && this.op[this.type].isValidate(e);
},
clear: function() {
return this.type && this.op[this.type].clear();
},
select: function(e) {
return this.tab.select(e);
}
});
return N;
} catch (C) {
wx.jslog({
src: "common/wx/richEditor/msgSender.js"
}, C);
}
});define("common/wx/simplePopup.js", [ "tpl/simplePopup.html.js", "common/wx/popup.js", "biz_common/jquery.validate.js" ], function(e, t, n) {
try {
var r = +(new Date);
"use strict";
var i = e("tpl/simplePopup.html.js");
e("common/wx/popup.js"), e("biz_common/jquery.validate.js");
function s(e) {
var t = $.Deferred(), n = this;
n.$dom = $(template.compile(i)(e)).popup({
title: e.title || "输入提示框",
buttons: [ {
text: "确认",
click: function() {
var i = this;
if (r.form()) {
var s = n.$dom.find("input").val().trim();
if (e.callback) {
var o = e.callback.call(i, s);
o !== !1 && this.remove();
} else this.remove();
t.resolve(s);
}
},
type: "primary"
}, {
text: "取消",
click: function() {
this.remove();
},
type: "default"
} ],
className: "simple label_block"
}), n.$dom.find("input").val(e.value).focus(), $.validator.addMethod("_popupMethod", function(t, n, r) {
return e && e.rule && e.rule(t.trim(), n, r);
}, e.msg);
var r = n.$dom.find("form").validate({
rules: {
popInput: {
required: !0,
_popupMethod: !0
}
},
messages: {
popInput: {
required: "输入框内容不能为空"
}
},
onfocusout: !1
});
return t.callback = t.done, t;
}
n.exports = s;
} catch (o) {
wx.jslog({
src: "common/wx/simplePopup.js"
}, o);
}
});define("advanced/menuSetting.js", [ "common/wx/Tips.js", "common/wx/simplePopup.js", "common/wx/dialog.js", "common/wx/Cgi.js", "common/wx/richEditor/msgSender.js", "common/wx/media/factory.js", "common/qq/mask.js", "biz_common/xss.js", "biz_common/moment.js", "common/qq/emoji.js", "biz_web/lib/json.js", "biz_common/jquery.ui/jquery.ui.sortable.js" ], function(e, t, n) {
try {
var r = +(new Date);
"use strict";
var i = e("common/wx/Tips.js"), s = e("common/wx/simplePopup.js"), o = e("common/wx/dialog.js"), u = e("common/wx/Cgi.js"), a = e("common/wx/richEditor/msgSender.js"), f = e("common/wx/media/factory.js"), l = e("common/qq/mask.js"), c = e("biz_common/xss.js"), h = e("biz_common/moment.js");
e("common/qq/emoji.js"), e("biz_web/lib/json.js"), e("biz_common/jquery.ui/jquery.ui.sortable.js");
function p(e) {
this.data = e;
}
p.prototype = {
cgi: "/advanced/operselfmenu?op=update&f=json",
get: function(e) {
var t = this, n;
return this.data.each(function(t, r) {
t.id == e && (n = t);
}), n;
},
getSub: function(e, t, n) {
var r, i;
return n === !0 ? this.data.each(function(e, n) {
e.subs && e.subs.each(function(e, n) {
if (e.id == t) return i = e, !1;
});
}) : (r = this.get(e), r.subs.each(function(e, n) {
e.id == t && (i = e);
})), i;
},
add: function(e, t) {
var n = (new Date).getTime() + "_menu_" + this.data.length;
this.data.push({
name: e,
id: n,
type: 1
}), this.post(t, n);
},
addSub: function(e, t, n) {
e.type = 0, e.act = null, e.subs || (e.subs = []);
var r = (new Date).getTime() + "_subMenu_" + e.id + "_" + e.subs.length;
e.subs.push({
name: t,
id: r,
type: 1
}), this.post(n, r);
},
del: function(e, t) {
var n = this;
$.each(this.data, function(t, r) {
if (r.id == e) return n.data.splice(t, 1), !1;
}), this.post(t);
},
delSub: function(e, t, n) {
var r = this.get(e);
r.subs.each(function(e, n) {
if (e.id == t) return r.subs.splice(n, 1), !1;
}), r.subs.length == 0 && (r.type = 1), this.post(n);
},
edit: function(e, t, n) {
e.name = t, this.post(n);
},
sort: function(e, t) {
var n = this, r = [], s = !1;
e.each(function(e, t) {
var o = [];
e.subs.each(function(t, r) {
o.push(n.getSub(e.id, t, !0));
});
var u = n.get(e.id);
u = Object.clone(u, !0), u.subs = o;
if (u.subs.length > 5) return i.err("二级菜单最多只能5个"), s = !0, !1;
r.push(u);
});
if (s) return;
n.data = r, this.post(t);
},
post: function(e, t) {
var n = this;
u.post({
url: n.cgi,
data: {
info: n.adapt(n.data)
},
mask: !0
}).success(function(n) {
n.BizBaseRetResp.Ret == 0 ? (e(), t && $("#" + t).trigger("click")) : n.BizBaseRetResp.Ret == 11 ? i.err("菜单跳转链接URL可能存在安全风险，请检查") : i.err("系统发送异常失败，页面即将重置刷新");
});
},
adapt: function(e) {
function t(e) {
if (e) {
var t = {};
return $.each(e, function(e, n) {
e.endsWith("_data") || (e == "value" ? t.value = (n + "").html(!1) : t[e] = n);
}), [ t ];
}
return [];
}
var n = [];
return $.each(e, function(e, r) {
var i = {
name: r.name.html(!1),
type: r.type
};
i.act_list = [], r.subs && r.subs.length > 0 ? (i.sub_button_list = [], $.each(r.subs, function(e, n) {
i.sub_button_list.push({
name: n.name.html(!1),
act_list: t(n.act),
type: n.type,
sub_button_list: []
});
})) : i.act_list = t(r.act), n.push(i);
}), console.log(n), JSON.stringify2({
version: wx.cgiData.menu.version,
name: wx.cgiData.menu.name,
button_list: n
});
}
};
var d, v = function() {
function e() {
t(), g.init(), y.init(), b.init(), m.init();
}
function t() {
wx.cgiData.menu = wx.cgiData.menu;
var e = [];
$.each(wx.cgiData.menu && wx.cgiData.menu.button_list, function(t, n) {
var r = {
name: n.name,
id: "menu_" + t,
type: n.type
};
if (n.sub_button_list.length > 0) {
var i = [];
$.each(n.sub_button_list, function(e, t) {
i.push({
name: t.name,
act: t.act_list[0],
id: "subMenu_" + r.id + "_" + e,
type: t.type
});
}), r.subs = i;
} else r.act = n.act_list[0];
e.push(r);
}), d = new p(e), window.myMenu = d;
}
return {
init: e
};
}(), m = function() {
function e() {
t(), s();
}
function t() {
var e = MenuData;
e.is.selfMenu ? ($("#menu_container").show(), $("#div_start").show(), $("#div_stop").hide()) : ($("#menu_container").hide(), $("#div_start").hide(), $("#div_stop").show()), e.is.isOpen ? $("#div_alertTips").hide() : ($("#div_alertTips").show(), $("#btn_start").removeClass("btn_primary").addClass("btn_disabled"), $("#btn_stop").removeClass("btn_warn").addClass("btn_disabled")), console.log(e), e.is.isOpen && e.is.selfMenu ? n(e) : $("#menuStatus").hide();
}
function n(e) {
console.log(e), e.selfMenu.hasMenu ? ($("#menuStatus").show(), e.selfMenu.status == "0" ? $("#menustatus_0").show() : e.selfMenu.status == "1" ? $("#menustatus_1").show() : e.selfMenu.status == "2" ? $("#menuStatus").hide() : e.selfMenu.status == "3" && $("#menustatus_3").html("<p>待发布，还有" + e.selfMenu.leftTime + "小时</p>").show()) : $("#menuStatus").hide();
}
function r(e) {
var n = {
type: "POST",
url: "/misc/skeyform?form=advancedswitchform&lang=zh_CN",
dataType: "json"
}, r = e ? 1 : 0, s, u = 3, a = [ "关闭自定义菜单之后，将在24小时内对所有用户生效。确认关闭？", "开启自定义菜单之后，将在24小时内对所有用户生效。确认开启？" ];
o.show({
type: "warn",
msg: "操作确认|" + a[r ? 1 : 0],
buttons: [ {
text: "确定",
click: function() {
s = $.extend(!0, {}, n, {
data: {
flag: r,
type: u,
token: wx.data.t
},
success: function(e) {
e.base_resp.ret == 0 ? (i.suc("操作成功"), MenuData.is.selfMenu = r, MenuData.is.isOpen || (MenuData.is.isOpen = !0), t()) : i.err("系统发生错误，请稍后重试");
}
}), $.ajax(s), this.remove();
}
}, {
text: "取消",
type: "normal",
click: function() {
this.remove();
}
} ]
});
}
function s() {
$("#div_stop .btn_primary").click(function() {
r(!0);
}), $("#div_start .btn_warn").click(function() {
r(!1);
}), $(".detail_desc").click(function() {
$("#detail_pop").popup({
buttons: [ {
text: "我知道了",
click: function() {
this.hide();
},
type: "primary"
} ],
title: "提示"
});
});
}
return {
init: e
};
}(), g = function() {
function e() {
t(), r();
}
function t() {
$("#menuList").html(template.render("tpl", d)), $(".jsMenu").sortable({
items: ".jslevel2",
placeholder: "sub_drag_placeholder",
dropOnEmpty: !0,
start: function(e, t) {
t.item.addClass("dragging");
},
stop: function(e, t) {
t.item.removeClass("hover").removeClass("dragging");
}
}), $(".jsMenu").sortable("disable"), $("#menuList").sortable({
items: ".jsMenu",
placeholder: "drag_placeholder",
dropOnEmpty: !0,
start: function(e, t) {
t.item.addClass("dragging");
},
stop: function(e, t) {
t.item.removeClass("dragging");
}
}), $("#menuList").sortable("disable");
}
function n() {
return a;
}
function r() {
var e;
$("#orderBt").click(function(t) {
e = Object.clone(d.data, !0), $("#menuList").addClass("sorting"), $("#addBt").hide(), $("#orderBt").hide(), $("#finishBt").show(), $("#cancelBt").show(), $(".jsOrderBt").show().siblings().hide(), $("#menuList").sortable("enable"), $(".jsMenu").sortable("enable");
}), $("#cancelBt").click(function(n) {
e && (d = new p(e), t(), e = null), $("#menuList").removeClass("sorting"), $("#addBt").show(), $("#orderBt").show(), $("#finishBt").hide(), $("#cancelBt").hide(), $(".jsOrderBt").hide().siblings().show(), $("#menuList").sortable("disable");
}), $("#finishBt").click(function(e) {
var n = [];
$(".jslevel1").each(function(e, t) {
var r = {
id: t.id,
subs: []
};
$(t).siblings(".jslevel2").each(function(e, t) {
r.subs.push(t.id);
}), n.push(r);
}), d.sort(n, t), $("#menuList").removeClass("sorting"), $("#addBt").show(), $("#orderBt").show(), $("#finishBt").hide(), $("#cancelBt").hide(), $(".jsOrderBt").hide().siblings().show(), $("#menuList").sortable("disable");
}), $("#menuList").on("click", "dt>a", function() {
if ($(this).parent().hasClass("selected")) return;
$("#menuList").find("dd,dt").removeClass("selected"), $(this).parent().addClass("selected"), a = d.get($(this).parent()[0].id), y.refresh(a);
}), $("#menuList").on("click", "dd>a", function() {
if ($(this).parent().hasClass("selected")) return;
$("#menuList").find("dd,dt").removeClass("selected"), $(this).parent().addClass("selected"), a = d.getSub($(this).parent().siblings("dt")[0].id, $(this).parent()[0].id), y.refresh(a);
}), $("#addBt").click(function() {
if (d.data.length >= 3) {
i.err("一级菜单最多只能三个");
return;
}
(new s({
label: "菜单名称名字不多于4个汉字或8个字母",
rule: function(e) {
return e.len() <= 8;
},
msg: "菜单名称名字不多于4个汉字或8个字母"
})).callback(function(e) {
d.add(e, t);
});
}), $("#menuList").on("click", ".jsDelBt", function() {
var e = $(this).closest("dt")[0].id;
o.show({
type: "warn",
msg: "删除确认|删除后该菜单下设置的消息将不会被保存",
buttons: [ {
text: "确定",
click: function() {
d.del(e, function() {
t(), y.refresh();
}), this.remove();
}
}, {
text: "取消",
type: "normal",
click: function() {
this.hide();
}
} ]
});
}), $("#menuList").on("click", ".jsEditBt", function() {
var e = $(this).closest("dt")[0].id, n = d.get(e);
new s({
label: "菜单名称名字不多于4个汉字或8个字母",
value: n.name.html(!1),
rule: function(e) {
return e.len() <= 8;
},
msg: "菜单名称名字不多于4个汉字或8个字母",
callback: function(e) {
d.edit(n, e, t);
}
});
}), $("#menuList").on("click", ".jsAddBt", function() {
var e = $(this).closest("dt")[0].id, n = d.get(e);
n && n.subs && n.subs.length >= 5 ? i.err("二级菜单最多只能5个") : n.act ? o.show({
type: "warn",
msg: "二级菜单确认|使用二级菜单后,当前编辑的消息将会被清除。确定使用二级菜单?",
buttons: [ {
text: "确定",
click: function() {
new s({
label: "菜单名称名字不多于8个汉字或16个字母:",
rule: function(e) {
return e.len() <= 16;
},
msg: "菜单名称名字不多于8个汉字或16个字母",
callback: function(e) {
d.addSub(n, e, t);
}
}), this.remove();
}
}, {
text: "取消",
type: "normal",
click: function() {
this.hide();
}
} ]
}) : new s({
label: "菜单名称名字不多于8个汉字或16个字母:",
rule: function(e) {
return e.len() <= 16;
},
msg: "菜单名称名字不多于8个汉字或16个字母",
callback: function(e) {
d.addSub(n, e, t);
}
});
}), $("#menuList").on("click", ".jsSubDelBt", function() {
var e = $(this).closest("dd").siblings("dt")[0].id, n = $(this).closest("dd")[0].id;
o.show({
type: "warn",
msg: "删除确认|删除后该菜单下设置的消息将不会被保存",
buttons: [ {
text: "确定",
click: function() {
d.delSub(e, n, function() {
t(), y.refresh();
}), this.remove();
}
}, {
text: "取消",
type: "normal",
click: function() {
this.hide();
}
} ]
});
}), $("#menuList").on("click", ".jsSubEditBt", function() {
var e = $(this).closest("dd").siblings("dt")[0].id, n = $(this).closest("dd")[0].id, r = d.getSub(e, n);
new s({
label: "菜单名称名字不多于8个汉字或16个字母:",
value: r.name.html(!1),
rule: function(e) {
return e.len() <= 16;
},
msg: "菜单名称名字不多于8个汉字或16个字母",
callback: function(e) {
d.edit(r, e, t);
}
});
});
}
var u = "", a;
return {
init: e,
refresh: t,
getData: n
};
}(), y = function() {
function e() {
c.none("你可以先添加一个菜单，然后开始为其设置响应动作"), t();
}
function t() {
$("#sendMsg").click(function(e) {
c.edit();
}), $("#goPage").click(function(e) {
c.url();
}), $("#urlSave").click(function(e) {
var t = g.getData(), r = $("#urlText").val().trim();
!r.startsWith("http://") && !r.startsWith("https://") && (r = "http://" + r), $.validator.rules.url(r) ? ($("#urlFail").hide(), t.type = 2, t.act = {
type: 6,
value: r
}, u.get("/misc/checkurl?url=" + r + "&f=json&action=check").success(function(e) {
if (e.base_resp.ret == "10302") {
i.err("填写url是黑名单地址");
return;
}
d.post(function() {
n(t), $("#urlText").val(""), $("#urlFail").hide();
});
})) : $("#urlFail").show();
}), $("#urlBack").click(function(e) {
c.data.act ? c.view() : c.index();
}), $("#changeBt").click(function(e) {
c.data.act.type == 6 ? c.url(c.data.act.value) : c.edit();
}), $("#editBack").click(function(e) {
n(g.getData());
}), $("#editSave").click(function(e) {
var t = $(this).btn(!1), n = l.getData(!0);
n.error ? t.btn(!0) : (n.data.type == 10 ? n.data.type = 5 : n.data.type == 11 ? n.data.type = 8 : n.data.type == 15 && (n.data.type = 9), n = n.data, c.data.act = {
type: n.type,
value: n.app_id || n.file_id || n.content.html(!0),
_data: n
}, c.data.act._data.content && (c.data.act._data.content = c.data.act._data.content.html(!0)), d.post(function() {
t.btn(!0), c.view();
}));
});
}
function n(e) {
if (!e) {
c.none("你可以先添加一个菜单，然后开始为其设置响应动作");
return;
}
c.data = e;
switch (e && e.type) {
case 0:
c.none("已有子菜单，无法设置动作");
break;
case 1:
e.act ? c.view() : c.index();
break;
case 2:
c.view();
break;
case 3:
e.act.source = "file";
break;
case 3:
e.act.source = "file", e.act.id = e.act.file_id;
break;
default:
c.none("你可以先添加一个菜单，然后开始为其设置响应动作");
}
}
function r(e, t) {
var n;
n = s(t.act), e ? ($("#edit").show(), l ? l.setData(n) : l = new a("#editDiv", n ? {
data: n,
acl: wx.acl.msg_acl
} : {
acl: wx.acl.msg_acl
})) : (console.log(n), n && f.render("#viewDiv", n));
}
function s(e) {
if (!e) return null;
var t = null;
return Object.each(e, function(e, n) {
if (n.endsWith("_data")) return t = e, !1;
}), t.multi_item && t.multi_item.length == 1 && $.extend(t, t.multi_item[0]), t.type = e.type, t.type == 5 ? t.type = 10 : t.type == 8 ? t.type = 11 : t.type == 9 && (t.type = 15), t;
}
var o, l, c = {
none: function(e) {
this.reset(), $("#none").show().find("p").text(e);
},
index: function() {
this.reset(), $("#index").show();
},
url: function(e) {
this.reset(), $("#urlText").val(e && e.html(!1)).focus(), $("#url").show();
},
view: function() {
this.reset();
if (this.data.type == 1) switch (this.data.act.type) {
case 1:
$("#viewDiv").html(this.data.act.value.emoji()), $("#viewDiv").siblings("p").text("订阅者点击该子菜单会收到以下消息");
break;
case 7:
$("#viewDiv").text("发送名片");
break;
default:
r(!1, this.data);
} else this.data.type == 2 && ($("#viewDiv").html(this.data.act.value), $("#viewDiv").siblings("p").text("订阅者点击该子菜单会跳到以下链接"));
$("#view").show(), $("#changeBt").show();
},
edit: function() {
this.reset(), r(!0, this.data), $("#edit").show();
},
reset: function() {
$(".jsMain").hide(), $("#changeBt").hide(), $("#urlFail").hide();
}
};
return {
init: e,
refresh: n,
getData: s
};
}(), b = function() {
function e() {
$("#viewBt").click(function(e) {
$("#mobileDiv:hidden").length > 0 && (l.show({
spin: !1
}), $("#viewList").html(template.render("viewTpl", d)), $("#mobileDiv").show());
}), $("#viewClose").click(function(e) {
l.hide(), $("#mobileDiv").hide(), $("#viewShow").html("");
}), $("#viewList").on("click", ".jsView", function(e) {
$(this).parent().siblings().find(".jsSubViewDiv").hide();
var n = d.get($(this).parent()[0].id);
n.act ? t(n.act) : $(this).parent().find(".jsSubViewDiv").toggle();
}), $("#viewList").on("click", ".jsSubView", function(e) {
var n = d.getSub($(this).parents(".jsViewLi")[0].id, $(this).parent()[0].id);
n.act && t(n.act), $(".jsSubViewDiv").hide();
}), $("#pubBt").click(function(e) {
d.data.length > 0 ? o.show({
type: "warn",
msg: "发布确认|本次发布将在24小时内对所有用户生效。确认发布？",
buttons: [ {
text: "确定",
click: function() {
u.post({
url: "/advanced/operselfmenu?op=sync",
data: {
Version: wx.cgiData.menu.version
}
}, function(e) {
switch (e.BizBaseRetResp.Ret) {
case 0:
i.suc("发布成功");
break;
case 8:
i.err("空菜单，不能同步");
break;
case 9:
i.err("存在还未设置响应动作的菜单，请检查");
break;
case 10:
i.err("自定义菜单功能处于关闭状态，无法发布");
break;
default:
i.err("系统错误，请稍后再试");
}
}), this.remove();
}
}, {
text: "取消",
type: "normal",
click: function() {
this.hide();
}
} ]
}) : i.err("空菜单，不能同步");
});
}
function t(e) {
var t = {
src: $(".head .avatar").attr("src"),
id: "_view_" + new Date * 1
};
if (e.type == 6) {
window.open(e.value);
return;
}
$("#viewShow").append(template.compile(r)(t)).parent().scrollTop($("#viewShow")[0].scrollHeight);
if (e.type == 1) {
$("#" + t.id).html(e.value.emoji());
return;
}
f.render.defer("#" + t.id, y.getData(e));
}
var n = 0, r = '<li class="show_item"><img class="avatar" src="{src}"><div class="show_content" id="{id}"></div></li>';
return {
init: e
};
}();
v.init();
} catch (w) {
wx.jslog({
src: "advanced/menuSetting.js"
}, w);
}
});