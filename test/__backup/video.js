
//var vid1 = document.getElementById("vid1");
//var vid2 = document.getElementById("vid2");
btn1.disabled = false;
btn2.disabled = true;
btn3.disabled = true;
var pc1_local, pc1_remote;
var pc2_local, pc2_remote;
var localstream;
var sdpConstraints = {'mandatory': {
                        'OfferToReceiveAudio':true,
                        'OfferToReceiveVideo':true }};

function gotStream(stream){
  trace("Received local stream");
  // Call the polyfill wrapper to attach the media stream to this element.
  attachMediaStream(vid1, stream);
  localstream = stream;
  btn2.disabled = false;
}

function start() {
  trace("Requesting local stream");
  btn1.disabled = true;
  // Call into getUserMedia via the polyfill (adapter.js).
  getUserMedia({audio:true, video:true},
                gotStream, function() {});
}

function call() {
  btn2.disabled = true;
  btn3.disabled = false;
  trace("Starting calls");
  videoTracks = localstream.getVideoTracks();
  audioTracks = localstream.getAudioTracks();
  if (videoTracks.length > 0)
    trace("Using Video device: " + videoTracks[0].label);
  if (audioTracks.length > 0)
    trace("Using Audio device: " + audioTracks[0].label);

  // Create an RTCPeerConnection via the polyfill (adapter.js).
  var servers = null;
  pc1_local = new RTCPeerConnection(servers);
  pc1_remote = new RTCPeerConnection(servers);
  pc1_remote.onaddstream = gotRemoteStream1;
  pc1_local.onicecandidate = iceCallback1Local;
  pc1_remote.onicecandidate = iceCallback1Remote;
  trace("PC1: created local and remote peer connection objects");

  pc2_local = new RTCPeerConnection(servers);
  pc2_remote = new RTCPeerConnection(servers);
  pc2_remote.onaddstream = gotRemoteStream2;
  pc2_local.onicecandidate = iceCallback2Local;
  pc2_remote.onicecandidate = iceCallback2Remote;
  trace("PC2: created local and remote peer connection objects");

  pc1_local.addStream(localstream);
  trace("Adding local stream to pc1_local");
  pc1_local.createOffer(gotDescription1Local, onCreateSessionDescriptionError);

  pc2_local.addStream(localstream);
  trace("Adding local stream to pc2_local");
  pc2_local.createOffer(gotDescription2Local, onCreateSessionDescriptionError);
}

function onCreateSessionDescriptionError(error) {
  trace('Failed to create session description: ' + error.toString());
}

function gotDescription1Local(desc) {
  pc1_local.setLocalDescription(desc);
  trace("Offer from pc1_local \n" + desc.sdp);
  pc1_remote.setRemoteDescription(desc);
  // Since the "remote" side has no media stream we need
  // to pass in the right constraints in order for it to
  // accept the incoming offer of audio and video.
  pc1_remote.createAnswer(gotDescription1Remote,
                          onCreateSessionDescriptionError, sdpConstraints);
}

function gotDescription1Remote(desc) {
  pc1_remote.setLocalDescription(desc);
  trace("Answer from pc1_remote \n" + desc.sdp);
  pc1_local.setRemoteDescription(desc);
}

function gotDescription2Local(desc) {
  pc2_local.setLocalDescription(desc);
  trace("Offer from pc2_local \n" + desc.sdp);
  pc2_remote.setRemoteDescription(desc);
  // Since the "remote" side has no media stream we need
  // to pass in the right constraints in order for it to
  // accept the incoming offer of audio and video.
  pc2_remote.createAnswer(gotDescription2Remote,
                          onCreateSessionDescriptionError, sdpConstraints);
}

function gotDescription2Remote(desc) {
  pc2_remote.setLocalDescription(desc);
  trace("Answer from pc2_remote \n" + desc.sdp);
  pc2_local.setRemoteDescription(desc);
}

function hangup() {
  trace("Ending calls");
  pc1_local.close();
  pc1_remote.close();
  pc2_local.close();
  pc2_remote.close();
  pc1_local = pc1_remote = null;
  pc2_local = pc2_remote = null;
  btn3.disabled = true;
  btn2.disabled = false;
}

function gotRemoteStream1(e) {
  // Call the polyfill wrapper to attach the media stream to this element.
  attachMediaStream(vid2, e.stream);
  trace("PC1: Received remote stream");
}

function gotRemoteStream2(e) {
  // Call the polyfill wrapper to attach the media stream to this element.
  attachMediaStream(vid3, e.stream);
  trace("PC2: Received remote stream");
}

function iceCallback1Local(event) {
  handleCandidate(event.candidate, pc1_remote, "PC1: ", "local");
}

function iceCallback1Remote(event) {
  handleCandidate(event.candidate, pc1_local, "PC1: ", "remote");
}

function iceCallback2Local(event) {
  handleCandidate(event.candidate, pc2_remote, "PC2: ", "local");
}

function iceCallback2Remote(event) {
  handleCandidate(event.candidate, pc2_local, "PC2: ", "remote");
}

function handleCandidate(candidate, dest, prefix, type) {
  if (candidate) {
    dest.addIceCandidate(new RTCIceCandidate(candidate),
                         onAddIceCandidateSuccess, onAddIceCandidateError);
    trace(prefix + "New " + type + " ICE candidate: " + candidate.candidate);
  }
}

function onAddIceCandidateSuccess() {
  trace("AddIceCandidate success.");
}

function onAddIceCandidateError(error) {
  trace("Failed to add Ice Candidate: " + error.toString());
}



