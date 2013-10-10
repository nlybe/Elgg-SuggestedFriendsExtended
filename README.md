
This plugin helps the users to find people they may know using several criteria. 
It is based on Suggested Friends by Matt Beckett (http://community.elgg.org/plugins/869921/1.2/suggested-friends-18x).

Initial development of this plugin was funded by Wogker and www.agujero.net.

== Contents ==
1. Features
2. Installation
3. ToDo

I. Features

Option to select criteria for suggesting friends:

- friends of friends
- people on same group
- same or opposite sex (field sex)
- same age (field age)
- same interests (field interests)
- same location (field location)
- nearby users using certain distance radius (field location)

Option for how many friends to suggest.
English and Spanish language files.


II. Installation

Requires: Elgg 1.8 or higher

- Upload suggested_friends_extended in "/mod/" elgg folder and activate it
- In Administration/Configure/Settings/Suggested Friends Extended you can configure several options and proposed criteria
- In case you select the option for suggesting friends using certain distance radius, in Administration/Configure/Settings/Suggested Friends Extended, run once 'Start Geolocation' for geolocate current users (no required again in future) 
- If using Profile Manager, you can import the file custom_profile_fields.backup.json.txt which includes the suggested fields


III. ToDo

Add more criteria according to community suggestions
