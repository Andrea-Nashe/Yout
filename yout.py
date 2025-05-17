import requests
import base64

headers = {"Authorization": "API_KEY"}
video_url = base64.b64encode("VIDEO_URL".encode()).decode()
r = requests.post(
    url="https://dvr.yout.com/mp3",
    headers=headers,
    data={
        "video_url": video_url,
        "start_time": False,
        "end_time": False,
        "title": "Hello world",
        "artist": "Hello world",
        "audio_quality": '128k',
    }
)

if r.status_code == 200:
    with open("audio.mp3", "wb") as fd:
        for chunk in r.iter_content(chunk_size=128):
            fd.write(chunk)
else:
    print(r.status_code)
    print(r.text)