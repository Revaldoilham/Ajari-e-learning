# TODO: Change OnboardingScreen Gradient to Blue from Bottom to Top and Remove Debug Banner

## Information Gathered

- `lib/main.dart`: Contains OnboardingScreen with a gradient overlay using LinearGradient from transparent to black (top to bottom).
- debugShowCheckedModeBanner is already set to false in MaterialApp.

## Plan

- Update the LinearGradient in OnboardingScreen to start from bottom (Alignment.bottomCenter) to top (Alignment.topCenter) with blue colors.
- Confirm debug banner is removed (already false).

## Dependent Files to be edited

- `lib/main.dart`

## Followup steps

- Run the Flutter app to verify the gradient change and debug banner removal.
