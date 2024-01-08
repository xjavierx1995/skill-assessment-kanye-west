import { User } from "./UserStore.interface";

export interface AuthStore {
  access_token: string;
}

export interface AuthResponse {
  token: string;
  user: User;
}
