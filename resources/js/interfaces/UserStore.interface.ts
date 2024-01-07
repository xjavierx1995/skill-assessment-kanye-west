import { Favorites } from "./Favorites.interface";

export interface UserStore {
  user: User | undefined;
  // favorites: Favorites[];
}

export interface User {
  id: number;
  name: string;
  email: string;
  isAdmin: boolean;
  canLogin: boolean;
}
